<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Shared\Locker;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Unit\TransferObject\Helper\FileTrait;
use Picamator\TransferObject\Shared\Exception\FileLockerException;
use Picamator\TransferObject\Shared\Locker\FileLocker;

#[Group('shared')]
final class FileLockerTest extends TestCase
{
    use FileTrait;

    private FileLocker&MockObject $fileLockerMock;

    protected function setUp(): void
    {
        $this->fileLockerMock = $this->getMockBuilder(FileLocker::class)
            ->onlyMethods([
                'fclose',
                'flock',
                'fopen',
            ])
            ->getMock();
    }

    #[TestDox('Failed to open the lock should throw exception')]
    public function testFailedToOpenTheLockShouldThrowException(): void
    {
        // Arrange
        $lockFile = 'some.lock';

        // Expect
        $this->fileLockerMock->expects($this->once())
            ->method('fopen')
            ->with($lockFile)
            ->willReturn(false)
            ->seal();

        $this->expectException(FileLockerException::class);

        // Act
        $this->fileLockerMock->acquireLock($lockFile);
    }

    #[TestDox('Failed to lock should throw exception')]
    public function testFailedToLockShouldThrowException(): void
    {
        // Arrange
        $lockFile = 'some.lock';
        $file = self::openFile();

        // Expect
        $this->fileLockerMock->expects($this->once())
            ->method('fopen')
            ->with($lockFile)
            ->willReturn($file);

        $this->fileLockerMock->expects($this->once())
            ->method('flock')
            ->with($this->isResource(), LOCK_EX)
            ->willReturn(false);

        $this->fileLockerMock->expects($this->once())
            ->method('fclose')
            ->with($this->isResource())
            ->willReturn(true)
            ->seal();

        $this->expectException(FileLockerException::class);

        // Act
        $this->fileLockerMock->acquireLock($lockFile);
    }

    #[TestDox('Release empty lock should early return')]
    public function testReleaseEmptyLockShouldEarlyReturn(): void
    {
        // expect
        $this->fileLockerMock->expects($this->never())
            ->method('flock');

        $this->fileLockerMock->expects($this->never())
            ->method('fclose')
            ->seal();

        // Act
        $this->fileLockerMock->releaseLock();
    }
}
