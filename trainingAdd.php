
<?php
session_start();
include("db_connection.php");
?>

<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Add Training Sessions</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

    </head>
    <body>
        <?php
        include("sidebar.php");
        ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Training Sessions
                        <small>[Add]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="trainingMain.php">Training Session List</a></li>
                        <li class="active">Training Sessions Add</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Training Sessions</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <!--<form role="form">-->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Training ID</label>
                                                <input type="text" class="form-control" placeholder="training id" disabled/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Department</label>
                                                <select class="form-control">
                                                    <option>Sales</option>
                                                    <option>Marketing</option>
                                                    <option>Production</option>
                                                    <option>Accounting</option>
                                                    <option>General</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Training Description</label>
                                                <textarea class="form-control" name="address" id="address" rows="3" placeholder="description" ></textarea>
                                            </div>    
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->

                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-xs-1">
                                            <label>1. </label>
                                        </div>
                                        <div class="col-xs-11">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Question"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Answer"/>
                                    </div>
                                    &nbsp;

                                    <div class="row">
                                        <div class="col-xs-1">
                                            <label>2. </label>
                                        </div>
                                        <div class="col-xs-11">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Question"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Answer"/>
                                    </div>
                                    &nbsp;

                                    <div class="row">
                                        <div class="col-xs-1">
                                            <label>3. </label>
                                        </div>
                                        <div class="col-xs-11">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Question"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Answer"/>
                                    </div>
                                    &nbsp;

                                    <div class="row">
                                        <div class="col-xs-1">
                                            <label>4. </label>
                                        </div>
                                        <div class="col-xs-11">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Question"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Answer"/>
                                    </div>
                                    &nbsp;

                                    <div class="row">
                                        <div class="col-xs-1">
                                            <label>5. </label>
                                        </div>
                                        <div class="col-xs-11">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Question"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Answer"/>
                                    </div>
                                    &nbsp;

                                    <div class="form-group"> 
                                        <label>6.Question</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                                                Option one is this and that&mdash;be sure to include why it's great
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                                Option two can be something else and selecting it will deselect option one
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
                                                Option three is disabled
                                            </label>
                                        </div>
                                    </div>
                                    &nbsp;

                                    <div class="form-group"> 
                                        <label>7.Question</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                                                Option one is this and that&mdash;be sure to include why it's great
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                                Option two can be something else and selecting it will deselect option one
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
                                                Option three is disabled
                                            </label>
                                        </div>
                                    </div>
                                    &nbsp;

                                    <div class="form-group"> 
                                        <label>8.Question</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                                                Option one is this and that&mdash;be sure to include why it's great
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                                Option two can be something else and selecting it will deselect option one
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
                                                Option three is disabled
                                            </label>
                                        </div>
                                    </div>
                                    &nbsp;

                                    <div class="form-group"> 
                                        <label>9.Question</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                                                Option one is this and that&mdash;be sure to include why it's great
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                                Option two can be something else and selecting it will deselect option one
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
                                                Option three is disabled
                                            </label>
                                        </div>
                                    </div>
                                    &nbsp;

                                    <div class="form-group"> 
                                        <label>10.Question</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                                                Option one is this and that&mdash;be sure to include why it's great
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                                Option two can be something else and selecting it will deselect option one
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
                                                Option three is disabled
                                            </label>
                                        </div>
                                    </div>
                                    &nbsp;

                                    <div class="col-md-1"><button type="text" class="btn btn-primary" style="width:100%">Add</button></div>
                                    <div class="col-md-1"><button type="text" class="btn btn-primary" style="width:100%">Cancel</button></div>
                                </div>
                                <!--                                </form>-->
                            </div><!-- /.box -->
                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

    </body>
</html>

