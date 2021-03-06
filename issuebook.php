<?php include("conecton.php"); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>GNDPC | Library</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue">
    <!-- Site wrapper -->
    <div class="wrapper">
      
      <?php include('header.php'); ?>
      <?php include('sidebar.php'); ?>

      <!-- =============================================== -->

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Book Bank
            <small>All Details</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Bank</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Book Center</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            <div class="box-body">
              <div class="box">
                <div class="box-header">
                 
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Author's Name</th>
                        <th>ISBN</th>
                        <th>Publisher</th>
                        <th>Status</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $get_books="SELECT * FROM bookbank ";
                        $get_books_query=mysqli_query($conn,$get_books);
                        $get_purchase_num=mysqli_num_rows($get_books_query);
                        if ($get_purchase_num != 0) {
                          
                        
                        $get_books_fetch=mysqli_fetch_array($get_books_query);

                        do
                       {
                         $Name=$get_books_fetch['Name'];
                         $Author_name=$get_books_fetch['Author_name'];
                         $ISBN=$get_books_fetch['ISBN'];
                        
                         $Publisher=$get_books_fetch['Publisher'];
                         
                         
                          // $dateObj   = DateTime::createFromFormat('!m', $Month);
                          // $Month = $dateObj->format('F'); // Month Name

                         echo '<tr>
                                <td>'.$Name.'</td>';
                                echo  '<td>'.$Author_name.'</td>
                                <td>'.$ISBN.'</td>
                                <td>'.$Publisher.'</td>';
                                $sql="SELECT * from book_issue where ISBN='$ISBN' ORDER BY id DESC";
                                $query=mysqli_query($conn,$sql);
                                $num=mysqli_num_rows($query);
                                if ($num==0) {
                                	 echo  '<td><a href="qrcode.php?ISBN='.$ISBN.'" ><span class="label label-success pull-middle">Available</span></a></td>';
                                }
                                else
                                {
                                $fetch=mysqli_fetch_array($query);
                                if ($fetch['Purpose'] != "issued")
                                 {                            
                                
                                   echo  '<td><a href="qrcode.php?ISBN='.$ISBN.'" ><span class="label label-success pull-middle">Available</span></a></td>';

                                 }

                          else
                          {
                             echo  '<td><span class="label label-warning pull-middle">ISSUED</span>&nbsp<a href="qrcode.php?ISBN='.$ISBN.'&p=r" ><span class="label label-success pull-middle">Return</span></a></td>';
                            
                          }
                               }
                                
                          echo '</tr>';
                        }
                        while ($get_books_fetch=mysqli_fetch_array($get_books_query));
                          }
                          else
                          {
                            echo "There is NO record";
                          }

                       ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Name</th>
                        <th>Author's Name</th>
                        <th>ISBN</th>
                        <th>Publisher</th>
                        <th>Status</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->







            </div><!-- /.box-body -->
            <div class="box-footer text-center">
             <b>Enjoy</b>
            </div><!-- /.box-footer-->
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2017-2018 <a href="http://webinfoera.com">Web InfoERA</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>
  </body>
</html>
<?php 
if (isset($_GET['userid']) && isset($_GET['ISBN'])  ) 
{
	$ISBN=$_GET['ISBN'];
	$user=$_GET['userid'];
	$purpose="issued";

	if (isset($_GET['p'])) {

		$check="SELECT * from book_issue where ISBN='$ISBN' and username='$user' order by id DESC";
		$check_q=mysqli_query($conn,$check);
		$check_n=mysqli_num_rows($check_q);
		if ($check_n==0) {
			echo '<script>alert("Book was not Issued"); window.location="issuebook.php"</script>';
		}
		else
		{
			$fetch_b=mysqli_fetch_array($check_q);
			if ($fetch_b['Purpose']=="issued") {
				
			$purpose="Returned";
			$sql="INSERT INTO book_issue (id, date, time, ISBN, username, Purpose) VALUES (NULL, '$date', '$time', '$ISBN', '$user', '$purpose')";
			$query=mysqli_query($conn,$sql);
			if ($query) {
				echo '<script>alert("Book Returned"); window.location="issuebook.php"</script>';
			}
			else
			{
				echo '<script>alert("Not appropriate to return"); window.location="issuebook.php"</script>';
			}
		}
		}

	}
	else
	{


 
$sql="INSERT INTO book_issue (id, date, time, ISBN, username, Purpose) VALUES (NULL, '$date', '$time', '$ISBN', '$user', '$purpose')";
$query=mysqli_query($conn,$sql);
if ($query) {
	echo '<script>alert("Book Issued"); window.location="issuebook.php"</script>';
}

}
	
}



 ?>