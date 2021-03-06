<?php
/**
 * 2007-2018 PrestaShop.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2018 PrestaShop SA
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

namespace PrestaShopBundle\Entity\Repository;

use Doctrine\DBAL\Connection;
use PrestaShop\PrestaShop\Core\Repository\RepositoryInterface;

/**
 * Class ImportMatchRepository retrieves import matches data from the database.
 */
class ImportMatchRepository implements RepositoryInterface
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var string database table name with prefix
     */
    private $importMatchTable;

    /**
     * @param Connection $connection
     * @param string $tablePrefix
     */
    public function __construct(Connection $connection, $tablePrefix)
    {
        $this->connection = $connection;
        $this->importMatchTable = $tablePrefix . 'import_match';
    }

    /**
     * Find one item by ID.
     *
     * @param int $id
     *
     * @return array
     */
    public function findOneById($id)
    {
        $queryBuilder = $this->connection
            ->createQueryBuilder()
            ->select('*')
            ->from($this->importMatchTable)
            ->where('id_import_match = :id')
            ->setParameter('id', $id)
        ;

        return $queryBuilder->execute()->fetch();
    }

    /**
     * Find one item by name.
     *
     * @param string $name
     *
     * @return array
     */
    public function findOneByName($name)
    {
        $queryBuilder = $this->connection
            ->createQueryBuilder()
            ->select('*')
            ->from($this->importMatchTable)
            ->where('`name` = :name')
            ->setParameter('name', $name)
        ;

        return $queryBuilder->execute()->fetch();
    }

    /**
     * {@inheritdoc}
     */
    public function findAll()
    {
        $queryBuilder = $this->connection
            ->createQueryBuilder()
            ->select('*')
            ->from($this->importMatchTable)
        ;

        return $queryBuilder->execute()->fetchAll();
    }

    /**
     * Delete one import match by it's id.
     *
     * @param int $id
     */
    public function deleteById($id)
    {
        $this->connection->delete(
            $this->importMatchTable,
            [
                'id_import_match' => $id,
            ]
        );
    }
}
