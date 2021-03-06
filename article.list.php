<?php
		require_once('connect.php');
		include("admin/page.class.php");
		$pagesize=5;//定义每页显示的条数
		$countSQL="SELECT COUNT(*) FROM article";
		$num_query=mysqli_query($con,$countSQL);
		$rs=mysqli_fetch_array($num_query);
		$count=$rs[0];//所有数据条数
		$pagenum=ceil($count/$pagesize);
		$page=(isset($_GET['page'])&&($_GET['page'])<=$pagenum)?$_GET['page']:1;
		$sql="SELECT * FROM article ORDER BY dateline DESC LIMIT ".($page-1)*$pagesize.",".$pagesize;
		$query=mysqli_query($con,$sql);
		if ($query&&mysqli_num_rows($query)) {
			while ($item=mysqli_fetch_assoc($query)) {
				$data[]=$item;
			}
		}else{
			$data[]=array();
		}
		
?>
<!DOCTYPE html>
<html lang="cmn-Hans-CN">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
<title>文章发布系统</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
<!-- start header -->
<div id="header">
	<div id="logo">
		<h1><a href="article.list.php">php与mysql<sup></sup></a></h1>
		<h2></h2>
	</div>
	<div id="menu">
		<ul>
			<li class="active"><a href="article.list.php">文章</a></li>
			<li><a href="about.php">关于我们</a></li>
			<li><a href="contact.php">联系我们</a></li>
		</ul>
	</div>
</div>
<!-- end header -->
</div>

<!-- start page -->
<div id="page">

	<!-- start content -->

	<div id="content">
		<?php
		if (!empty($data)) {
			foreach ($data as $value) {	
	?>
		<div class="post">
			<h1 class="title"><span style="color:#ccc;font-size:14px;">　　作者：<?php echo $value['author'] ?><!--作者放置到这里--></span></h1>
			<div class="entry">
				<?php echo $value['description'] ?>
			</div>
			<div class="meta">
				<p class="links"><a href="article.show.php?id=<?php echo $value['id'];?>" class="more">查看详细</a>&nbsp;&nbsp;&raquo;&nbsp;&nbsp;</p>
			</div>
		</div>
			<?php
				}
			}
	?>

<div>
		<?php
		$pages= new PageClass($page,$count,$pagesize,'article.list.php?page={page}');
		$pages->write();
		?>

</div>
	</div>


	<!-- end content -->

	<!-- start sidebar -->
	<div id="sidebar">
		<ul>
			<li id="search">
				<h2><b class="text1">Search</b></h2>
				<form method="get" action="article.search.php">
					<fieldset>
					<input type="text" id="s" name="key" value="" />
					<input type="submit" id="x" value="Search" />
					</fieldset>
				</form>
			</li>
		</ul>
	</div>
	<!-- end sidebar -->
	<div style="clear: both;">&nbsp;</div>


</div>
<!-- end page -->

<!-- start footer -->
<div id="footer">
	<p id="legal"></p>
</div>
<!-- end footer -->
</body>
</html>