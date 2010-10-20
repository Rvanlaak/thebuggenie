<?php

	/**
	 * Workflows table
	 *
	 * @author Daniel Andre Eikeland <zegenie@zegeniestudios.net>
	 ** @version 3.0
	 * @license http://www.opensource.org/licenses/mozilla1.1.php Mozilla Public License 1.1 (MPL 1.1)
	 * @package thebuggenie
	 * @subpackage tables
	 */

	/**
	 * Workflows table
	 *
	 * @package thebuggenie
	 * @subpackage tables
	 */
	class TBGWorkflowsTable extends B2DBTable
	{

		const B2DBNAME = 'workflows';
		const ID = 'workflows.id';
		const SCOPE = 'workflows.scope';
		const NAME = 'workflows.name';
		const DESCRIPTION = 'workflows.description';
		const IS_ACTIVE = 'workflows.is_active';

		/**
		 * Return an instance of this table
		 *
		 * @return TBGWorkflowsTable
		 */
		public static function getTable()
		{
			return B2DB::getTable('TBGWorkflowsTable');
		}

		public function __construct()
		{
			parent::__construct(self::B2DBNAME, self::ID);
			parent::_addForeignKeyColumn(self::SCOPE, TBGScopesTable::getTable(), TBGScopesTable::ID);
			parent::_addVarchar(self::NAME, 200);
			parent::_addText(self::DESCRIPTION, false);
			parent::_addBoolean(self::IS_ACTIVE);
		}

		public function getAll($scope = null)
		{
			$scope = ($scope === null) ? TBGContext::getScope()->getID() : $scope;
			$crit = $this->getCriteria();
			$crit->addWhere(self::SCOPE, $scope);

			$res = $this->doSelect($crit);

			return $res;
		}

		public function getByID($id)
		{
			$crit = $this->getCriteria();
			$crit->addWhere(self::SCOPE, TBGContext::getScope()->getID());
			$row = $this->doSelectById($id, $crit, false);
			return $row;
		}

	}