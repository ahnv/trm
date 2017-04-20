<?php
	session_start();
	require __DIR__."/src/autoload.php";
	if (!isset($_SESSION['logged_in']) && !$_SESSION['logged_in']){
		header('Location: '.URL.'logout');
	}
	if ((new LoginHelper($db))->getCurrentStatus($_SESSION['user_id'])){
		switch ($_SESSION['status']) {
			case '0':	header("Location: ".URL."unverified");	break;
			case '1':	break;
			case '2':	header("Location: ".URL."banned");	break;
		}
	}
	$page = "Dashboard";
	require 'header.php';
	$mails = (new mailerHelper($db))->getRecievedMails($_SESSION['user_id']);
	$sentmails = (new mailerHelper($db))->getSentMail($_SESSION['user_id']);
?>

<body>
<?php require 'nav.php'; ?>
	<div class="container" style="padding-top: 62px;">
		<div class="col-xs-12">
	                        <div class="row">
	                            <div class="col-md-2">
	                                <ul class="nav nav-pills nav-pills-rose nav-stacked">
	                                  <li class="active"><a href="#tab1" data-toggle="tab">Inbox</a></li>
	                                  <li><a href="#tab2" data-toggle="tab">Archived</a></li>
	                                  <li><a href="#tab3" data-toggle="tab">Deleted</a></li>
	                                  <li><a href="#tab4" data-toggle="tab">Sent Mail</a></li>
	                                </ul>
	                            </div>
	                            <div class="col-md-10">
	                            	<div class="tab-content">
	                            	    <div class="tab-pane active" id="tab1">
	                            	      <div class="col-xs-12">
	                            	      	 <table class="table table-striped">
					                            <tbody>
					                            	<?php for ($i=0; $i < count($mails['Inbox']) ; $i++):$mail = $mails['Inbox'][$i];?>
					                                <tr style="<?php if (!$mail['read']) echo 'font-weight: 700;';?>">
					                                    <td class="text-center"><i class="fa fa-envelope<?php if ($mail['read']) echo '-open-o';?>"></i></td>
					                                    <td><?php echo $mail['sid']; ?></td>
					                                    <td><?php echo $mail['subject'] ?></td>
					                                    <td><?php echo substr($mail['content'],0,25)."..." ?></td>
					                                    <td class="text-right"> <?php if ($mail['attachment']) echo '<i class="fa fa-paperclip" aria-hidden="true"></i>'; ?> </td>
					                                    <td class="text-right"><?php echo $mail['timestamp'] ?></td>
					                                    
					                                </tr>
					                            	<?php endfor; ?>
					                            </tbody>
					                        </table>
	                            	      </div>
	                            	    </div>
	                            	    <div class="tab-pane" id="tab2">
	                            	      	<div class="col-xs-12">
	                            	      	 <table class="table table-striped">
					                            <tbody>
					                            	<?php for ($i=0; $i < count($mails['Archived']) ; $i++):$mail = $mails['Archived'][$i];?>
					                                <tr style="<?php if (!$mail['read']) echo 'font-weight: 700;';?>">
					                                    <td class="text-center"><i class="fa fa-envelope<?php if ($mail['read']) echo '-open-o';?>"></i></td>
					                                    <td><?php echo $mail['sid']; ?></td>
					                                    <td><?php echo $mail['subject'] ?></td>
					                                    <td><?php echo substr($mail['content'],0,25)."..." ?></td>
					                                    <td class="text-right"> <?php if ($mail['attachment']) echo '<i class="fa fa-paperclip" aria-hidden="true"></i>'; ?> </td>
					                                    <td class="text-right"><?php echo $mail['timestamp'] ?></td>
					                                    
					                                </tr>
					                            	<?php endfor; ?>
					                            </tbody>
					                        </table>
	                            	      </div>
	                            	    </div>
	                            		<div class="tab-pane" id="tab3">
	                            			<div class="col-xs-12">
	                            				<table class="table table-striped">
					                            <tbody>
					                            	<?php for ($i=0; $i < count($mails['Deleted']) ; $i++):$mail = $mails['Deleted'][$i];?>
					                                <tr style="<?php if (!$mail['read']) echo 'font-weight: 700;';?>">
					                                    <td class="text-center"><i class="fa fa-envelope<?php if ($mail['read']) echo '-open-o';?>"></i></td>
					                                    <td><?php echo $mail['sid']; ?></td>
					                                    <td><?php echo $mail['subject'] ?></td>
					                                    <td><?php echo substr($mail['content'],0,25)."..." ?></td>
					                                    <td class="text-right"> <?php if ($mail['attachment']) echo '<i class="fa fa-paperclip" aria-hidden="true"></i>'; ?> </td>
					                                    <td class="text-right"><?php echo $mail['timestamp'] ?></td>
					                                    
					                                </tr>
					                            	<?php endfor; ?>
					                            </tbody>
					                        </table>
	                            	      	</div>
	                            	    </div>
	                            	    <div class="tab-pane" id="tab4">
	                            			<div class="col-xs-12">
	                            				<table class="table table-striped">
					                            <tbody>
					                            	<?php for ($i=0; $i < count($sentmails[0]) ; $i++):$mail = $sentmails[0][$i];?>
					                                <tr style="">
					                                    <td class="text-center"><i class="fa fa-envelope"></i></td>
					                                    <td><?php echo $mail['sid']; ?></td>
					                                    <td><?php echo $mail['subject'] ?></td>
					                                    <td><?php echo substr($mail['content'],0,25)."..." ?></td>
					                                    <td class="text-right"> </td>
					                                    <td class="text-right"><?php echo $mail['timestamp'] ?></td>
					                                    
					                                </tr>
					                            	<?php endfor; ?>
					                            </tbody>
					                        </table>
	                            	      	</div>
	                            	    </div>
	                            	</div>
	                            </div>
	                        </div>
	                    </div>
	</div>
<?php 
require 'footer.php';
?>