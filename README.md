# Monorepo - Build and Maintain Monorepo like a Boss

[![Build Status](https://img.shields.io/travis/Symplify/Monorepo/master.svg?style=flat-square)](https://travis-ci.org/Symplify/Monorepo)
[![Downloads](https://img.shields.io/packagist/dt/symplify/monorepo.svg?style=flat-square)](https://packagist.org/packages/symplify/monorepo)
[![Subscribe](https://img.shields.io/badge/subscribe-to--releases-green.svg?style=flat-square)](https://libraries.io/packagist/symplify%2Fmonorepo)

## Usage

### Build Monolitic Repository from Many Repositories

- Do you have **many packages with long git history**?
- Do you want to **turn them into monorepo**?
- Do you want **keep their history**?

That's exactly what `build` command does.

#### Directories to work With

You're working with 2 directories:

- **monorepo directory** - monorepo will be created there, it must be empty
- **build directory** - where you have `symplify/monorepo` installed, e.g.

    ```bash
    composer require symplify/monorepo
    ```

Do all following steps in **build directory**.

#### 3 Steps to Build Monorepo

1. Create `monorepo.yml` with `build` section

```yml
parameters:
    build:
        # remote git repository => directory in monorepo to place the package to
        'git@github.com:shopsys/product-feed-zbozi.git': 'packages/ProductFeedZbozi'
        'git@github.com:shopsys/product-feed-heureka.git': 'packages/ProductFeedHeureka'
```

2. Run `build` command with **monorepo directory** as argument

Remember, it must be outside this directory and must be empty.

```bash
vendor/bin/monorepo build ../new-monorepo
```

3. A new `/new-monorepo` directory is created, with git history for all the packages

```bash
/new-monorepo
    /packages
        /ProductFeedZbozi
        /ProductFeedHeureka
```

#### How to Add Repository to Root Directory?

Do you want to add remote repository not into the `packages/<name>` subdirectory but into the root directory?

```yml
# incorrect
parameters:
    build:
        'git@github.com:symplify/monorepo-skeleton.git': '.'
        'git@github.com:shopsys/product-feed-zbozi.git': 'packages/ProductFeedZbozi'
```

If it is the first one like in a list above, first `/src` directory is added in the root. Then another `/src` from `git@github.com:shopsys/product-feed-zbozi.git` will be added and will cause conflict.

In such case, **this package have to be last**:

```yml
# correct
parameters:
    build:
        'git@github.com:shopsys/product-feed-zbozi.git': 'packages/ProductFeedZbozi'
        'git@github.com:symplify/monorepo-skeleton.git': '.'
```
