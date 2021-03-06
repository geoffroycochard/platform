<?php
namespace Oro\Bundle\SecurityBundle\Tests\Unit\Acl\Cache;

use Oro\Bundle\SecurityBundle\Acl\Cache\AclCache;

class AclCacheTest extends \PHPUnit_Framework_TestCase
{
    /** @var AclCache */
    protected $aclCache;

    protected $cacheProvider;
    protected $permissionGrantingStrategy;
    protected $prefix;
    protected $underlyingCache;

    protected function setUp()
    {
        $this->cacheProvider = $this->createMock('Doctrine\Common\Cache\CacheProvider', array(
            'deleteAll', 'doFetch', 'doContains', 'doSave', 'doDelete', 'doFlush', 'doGetStats'
        ));
        $this->underlyingCache = $this->getMockBuilder('Oro\Bundle\SecurityBundle\Acl\Cache\UnderlyingAclCache')
            ->disableOriginalConstructor()
            ->getMock();
        $this->permissionGrantingStrategy =
            $this->getMockForAbstractClass('Symfony\Component\Security\Acl\Model\PermissionGrantingStrategyInterface');
        $this->prefix = 'test_prefix';
        $this->aclCache = new AclCache($this->cacheProvider, $this->permissionGrantingStrategy, $this->prefix);
        $this->aclCache->setUnderlyingCache($this->underlyingCache);
    }

    public function testClearCache()
    {
        $this->cacheProvider->expects($this->once())->method('deleteAll');
        $this->underlyingCache->expects($this->once())->method('clearCache');

        $this->aclCache->clearCache();
    }
}
