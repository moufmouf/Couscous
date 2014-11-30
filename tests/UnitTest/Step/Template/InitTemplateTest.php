<?php

namespace Couscous\Tests\UnitTest\Step\Template;

use Couscous\Step\Template\InitTemplate;
use Couscous\Tests\UnitTest\Mock\MockRepository;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Filesystem\Filesystem;

class InitTemplateTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultDirectory()
    {
        $step       = new InitTemplate($this->createFilesystem());
        $repository = new MockRepository();
        $step->__invoke($repository, new NullOutput());

        $this->assertEquals('/website', $repository->metadata['template.directory']);
    }

    public function testCustomDirectory()
    {
        $step       = new InitTemplate($this->createFilesystem());
        $repository = new MockRepository();
        $repository->metadata['template.directory'] = 'foo';
        $step->__invoke($repository, new NullOutput());

        $this->assertEquals('/foo', $repository->metadata['template.directory']);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Filesystem
     */
    private function createFilesystem()
    {
        $filesystem = $this->getMock('Symfony\Component\Filesystem\Filesystem');
        $filesystem->expects($this->any())
            ->method('exists')
            ->willReturn(true);
        return $filesystem;
    }
}