========================================
Original ReadMe from developers:
========================================

程序环境：PHP7.3+MYSQL5.6

Include此文件夹里config_db.php 是数据库连接文件
$sql_name   = "数据库名称";
$db_user   = "数据库账号";
$db_pass   = "数据库密码";
此信息对应写好

mysql.sql 这个是数据库文件，建立好数据库之后导入即可


后台地址是：域名/manasixvies/
初始账号admin密码admin888

========================================
How to update DB only
========================================

Host a local php webserver (e.g. MampPro)

In MampPro, set the SiteFolder to be this git directory. Then:
1. The website should be hosted at http://localhost:8888
2. The admin can be accessed at http://localhost:8888/manasixvies
3. The phpMyAdmin page to manage database can be accessed at http://localhost:8888/phpMyAdmin

If this is the first time, create database with name "fangliul_web", database user with name "fangliul_admin" and password "shanghai5487". If they need to be changed, also need to update
Include/config_db.php correspondingly. Import database from the file mysql.sql.

After modifying content using admin, export the database to a new file mysql_new.sql.

On Stanford domain dashboard, delete the database fangliul_web, re-create a database with the same name, remember to set the collation type to utf8_general_ci.
You can also try dropping all existing tables instead of deleting the database.
Import from the new file mysql_new.sql (if doing this way, then no need to set collation type again).
Test and confirm it works as expected.

In git repository, use mysql_new.sql to overwrite the old mysql.sql. Update the git repository remotely to keep records (git push -u origin main).

Then update the source code following the instruction in the next session.


========================================
How to update source code
========================================

Empty trash.
Delete all the existing files in public_html directory into trash.
Compress the git directory into a .zip file.
Upload that .zip file into public_html directory on the server.
Extract to public_html.
Move the content one level up to public_html. Now the unzipped folder is empty.
Test and confirm it works.

If it doesn't work, delete all the existing files in public_html directory permanently (not to trash).
Restore the files in trash.

If it works, empty trash. Delete the .zip file and the empty unzipped folder.
Now the public_html directory is in sync with the git directory.



