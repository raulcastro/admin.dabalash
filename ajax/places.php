<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once($root.'/models/back/Layout_Model.php');
require_once($root.'/views/Layout_View.php');
require_once $root.'/backends/admin-backend.php';
require_once $root.'/Framework/Tools.php';
$model	= new Layout_Model();


$memberId = (int) $_POST['memberId'];

switch ($_POST['opt'])
{
	case 1:	 
		
		if ($model->addPlace($_POST))
			echo 1;
		else
			echo 0;
		break;
		
	break;
	
	case 2:
		if ($model->deletePlace($_POST['placeId']))
			echo 1;
		else
			echo 0;
	break;
	
	case 3:
		if ($model->addSub($_POST))
			echo 1;
		else 
			echo 0;
	break;
	
	case 4:
		if ($model->deleteSub($_POST['subId']))
			echo 1;
		else
			echo 0;
	break;
	
	case 5:
		if ($subs = $model->getSubs($_POST['placeId']))
		{
			if ($subs)
			{
				foreach ($subs as $sub)
				{
					?>
			<div class="col-lg-3 col-md-5 sub-item" id="sub-item-<?php echo $sub['subplace_id']; ?>">
				<div class="box-body">
					<div class="sub-content-box">
						<div class="form-group">
							<label for="exampleInputEmail1"><?php echo $sub['place_title']; ?></label>
						</div>
						
						<div class="form-group">
							<?php echo nl2br($sub['place_content']); ?>
							</div>
						</div>
                        <div class="box-footer">
							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-danger pull-right btn-xs delete-sub" sub-id="<?php echo $sub['subplace_id']; ?>">Eliminar</button>
							</div>
						</div>
                  	</div>
				</div>
			</div>
					<?php
				}
					
			}
		}
	break;
	
	case 6:
		if ($model->updateSlider($_POST))
		{
			echo 1;
		}
	break;
	
	default:
	break;
}