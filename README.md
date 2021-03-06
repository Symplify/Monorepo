# Deprecated - use [shopsys/monorepo-tools](https://github.com/shopsys/monorepo-tools) instead

---

## Monorepo - Build and Maintain Monorepo like a Boss

[![Build Status](https://img.shields.io/travis/Symplify/Monorepo/master.svg?style=flat-square)](https://travis-ci.org/Symplify/Monorepo)
[![Downloads](https://img.shields.io/packagist/dt/symplify/monorepo.svg?style=flat-square)](https://packagist.org/packages/symplify/monorepo)
[![Subscribe](https://img.shields.io/badge/subscribe-to--releases-green.svg?style=flat-square)](https://libraries.io/packagist/symplify%2Fmonorepo)

## Usage

### 1. Build Monolithic Repository from Many Repositories

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

### 2. Split Monolithic Repository to Many Repositories

1. Create `monorepo.yml` with `split` section

```yml
parameters:
    split:
        directory in monorepo with package => remote git repository
        'packages/ProductFeedZbozi': 'git@github.com:shopsys/product-feed-zbozi.git'
        'packages/ProductFeedHeureka': 'git@github.com:shopsys/product-feed-heureka.git'
```

2. Run `split` command

```bash
vendor/bin/monorepo split
```

It splits current working directory, but you can use argument to change that:

```bash
vendor/bin/monorepo split ../new-monorepo
```

Your last tag and `master` branch is now published in the repository.

## Other Features

### Is Your Config in Other Location?

```bash
vendor/bin/monorepo split --config second-monorepo.yml
```

## Rules of Monorepo

- Only **committed files and directories** can be split.
- It **takes time** to move commit history of big projects (`build` command), e.g. for 7000 commits in 2500 files roughly 3 hours. Running script overnight is recommended.

### Built With Help Of

- [emiller/git-mv-with-history](https://gist.github.com/emiller/6769886) for `build` command
- [dflydev/git-subsplit](https://github.com/dflydev/git-subsplit) for `split` command
