CREATE DATABASE IF NOT EXISTS `testing`;
CREATE DATABASE IF NOT EXISTS `testing_test_1`;
CREATE DATABASE IF NOT EXISTS `testing_test_2`;
CREATE DATABASE IF NOT EXISTS `testing_test_3`;
CREATE DATABASE IF NOT EXISTS `testing_test_4`;
CREATE DATABASE IF NOT EXISTS `testing_test_5`;
CREATE DATABASE IF NOT EXISTS `testing_test_6`;
CREATE DATABASE IF NOT EXISTS `testing_test_7`;
CREATE DATABASE IF NOT EXISTS `testing_test_8`;

INSERT IGNORE INTO mysql.tables_priv (Host, Db, User, Table_name, Grantor, Timestamp, Table_priv, Column_priv)
SELECT Host, 'testing', User, '*', 'root@localhost', NOW(), 'Select,Insert,Update,Delete,Create,Drop,Grant,References,Index,Alter,Create View,Show view,Trigger,Event,Execute', ''
FROM mysql.user WHERE User NOT LIKE 'mysql.%'
UNION ALL
SELECT Host, 'testing_test_1', User, '*', 'root@localhost', NOW(), 'Select,Insert,Update,Delete,Create,Drop,Grant,References,Index,Alter,Create View,Show view,Trigger,Event,Execute', ''
FROM mysql.user WHERE User NOT LIKE 'mysql.%'
UNION ALL
SELECT Host, 'testing_test_2', User, '*', 'root@localhost', NOW(), 'Select,Insert,Update,Delete,Create,Drop,Grant,References,Index,Alter,Create View,Show view,Trigger,Event,Execute', ''
FROM mysql.user WHERE User NOT LIKE 'mysql.%'
UNION ALL
SELECT Host, 'testing_test_3', User, '*', 'root@localhost', NOW(), 'Select,Insert,Update,Delete,Create,Drop,Grant,References,Index,Alter,Create View,Show view,Trigger,Event,Execute', ''
FROM mysql.user WHERE User NOT LIKE 'mysql.%'
UNION ALL
SELECT Host, 'testing_test_4', User, '*', 'root@localhost', NOW(), 'Select,Insert,Update,Delete,Create,Drop,Grant,References,Index,Alter,Create View,Show view,Trigger,Event,Execute', ''
FROM mysql.user WHERE User NOT LIKE 'mysql.%'
UNION ALL
SELECT Host, 'testing_test_5', User, '*', 'root@localhost', NOW(), 'Select,Insert,Update,Delete,Create,Drop,Grant,References,Index,Alter,Create View,Show view,Trigger,Event,Execute', ''
FROM mysql.user WHERE User NOT LIKE 'mysql.%'
UNION ALL
SELECT Host, 'testing_test_6', User, '*', 'root@localhost', NOW(), 'Select,Insert,Update,Delete,Create,Drop,Grant,References,Index,Alter,Create View,Show view,Trigger,Event,Execute', ''
FROM mysql.user WHERE User NOT LIKE 'mysql.%'
UNION ALL
SELECT Host, 'testing_test_7', User, '*', 'root@localhost', NOW(), 'Select,Insert,Update,Delete,Create,Drop,Grant,References,Index,Alter,Create View,Show view,Trigger,Event,Execute', ''
FROM mysql.user WHERE User NOT LIKE 'mysql.%'
UNION ALL
SELECT Host, 'testing_test_8', User, '*', 'root@localhost', NOW(), 'Select,Insert,Update,Delete,Create,Drop,Grant,References,Index,Alter,Create View,Show view,Trigger,Event,Execute', ''
FROM mysql.user WHERE User NOT LIKE 'mysql.%';

-- Grant db privileges для всех 9 баз
INSERT IGNORE INTO mysql.db (Host, Db, User, Select_priv, Insert_priv, Update_priv, Delete_priv, Create_priv, Drop_priv, Grant_priv, References_priv, Index_priv, Alter_priv, Create_tmp_table_priv, Lock_tables_priv, Create_view_priv, Show_view_priv, Create_routine_priv, Alter_routine_priv, Execute_priv, Event_priv, Trigger_priv)
SELECT Host, 'testing', User, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'
FROM mysql.user WHERE User NOT LIKE 'mysql.%'
UNION ALL
SELECT Host, 'testing_test_1', User, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'
FROM mysql.user WHERE User NOT LIKE 'mysql.%'
UNION ALL
SELECT Host, 'testing_test_2', User, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'
FROM mysql.user WHERE User NOT LIKE 'mysql.%'
UNION ALL
SELECT Host, 'testing_test_3', User, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'
FROM mysql.user WHERE User NOT LIKE 'mysql.%'
UNION ALL
SELECT Host, 'testing_test_4', User, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'
FROM mysql.user WHERE User NOT LIKE 'mysql.%'
UNION ALL
SELECT Host, 'testing_test_5', User, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'
FROM mysql.user WHERE User NOT LIKE 'mysql.%'
UNION ALL
SELECT Host, 'testing_test_6', User, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'
FROM mysql.user WHERE User NOT LIKE 'mysql.%'
UNION ALL
SELECT Host, 'testing_test_7', User, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'
FROM mysql.user WHERE User NOT LIKE 'mysql.%'
UNION ALL
SELECT Host, 'testing_test_8', User, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'
FROM mysql.user WHERE User NOT LIKE 'mysql.%';

FLUSH PRIVILEGES;
