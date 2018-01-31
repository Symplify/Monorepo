<?php declare(strict_types=1);

namespace Symplify\Monorepo\Tests;

use GitWrapper\GitWrapper;
use Nette\Utils\FileSystem;
use Symfony\Component\Console\Output\OutputInterface;
use Symplify\Monorepo\RepositoryToPackageMerger;

final class RepositoryToPackageMergerTest extends AbstractContainerAwareTestCase
{
    const TEMP_MONOREPO_DIRECTORY = __DIR__ . '/RepositoryToPackageMergerSource/TempRepository';
    /**
     * @var GitWrapper
     */
    private $gitWrapper;

    /**
     * @var RepositoryToPackageMerger
     */
    private $repositoryToPackageMerger;

    protected function setUp(): void
    {
        $this->gitWrapper = $this->container->get(GitWrapper::class);
        $this->repositoryToPackageMerger = $this->container->get(RepositoryToPackageMerger::class);

        /** @var OutputInterface $output */
        $output = $this->container->get(OutputInterface::class);
        $output->setVerbosity(OutputInterface::VERBOSITY_QUIET);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function test(): void
    {
        $this->gitWrapper->init(self::TEMP_MONOREPO_DIRECTORY);

        $this->repositoryToPackageMerger->mergeRepositoryToPackage(
            'git@github.com:shopsys/product-feed-zbozi.git',
            self::TEMP_MONOREPO_DIRECTORY,
            'packages/ProductFeed'
        );
    }

    protected function tearDown(): void
    {
        FileSystem::delete(self::TEMP_MONOREPO_DIRECTORY);
    }
}