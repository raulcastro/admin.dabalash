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
		
		if ($newBook = $model->addStore($_POST))
			echo str_pad($newBook, 4, 0, STR_PAD_LEFT);
		else
			echo 0;
		break;
		
	break;
	
	case 2:
		if ($model->updateStore($_POST))
			echo 1;
		else
			echo 0;
	break;
	
	case 3:
		if ($model->deleteStore($_POST['storeId']))
			echo 1;
		else 
			echo 0;
	break;
	
	case 4:
		if ($sliders = $model->getSliders($_POST['storeId']))
		{
			foreach ($sliders as $slider)
			{
				?>
			<div class="col-lg-5 col-md-12 slider">
				<div class="marker-img">
					<img src="/images/sliders/medium/<?php echo $slider['slider']; ?>" class="img-responsive" />
				</div>
				<div class="box-body">
					<div class="form-group">
						<label for="exampleInputEmail1">Titulo</label>
						<input type="text" class="form-control" id="title-<?php echo $slider['slider_id']; ?>" placeholder="titulo ..." value="<?php echo $slider['title_slider']; ?>" >
					</div>
					
					<div class="form-group">
						<label for="exampleInputEmail1">Contenido</label>
						<input type="text" class="form-control" id="content-<?php echo $slider['slider_id']; ?>" placeholder="contenido ..." value="<?php echo $slider['content_slider']; ?>" >
					</div>
					
					<div class="form-group">
						<label for="exampleInputEmail1">URL</label>
						<input type="text" class="form-control" id="url-<?php echo $slider['slider_id']; ?>" placeholder="url ..." value="<?php echo $slider['url_slider']; ?>" >
						</div>
						
                        <div class="box-footer">
							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-danger pull-right btn-sm delete-slider" slider-id="<?php echo $slider['slider_id']; ?>">Delete</button>
								<button type="submit" class="btn btn-info pull-right btn-sm update-slider" slider-id="<?php echo $slider['slider_id']; ?>">Update</button>
							</div>
						</div>
	                    
                  	</div>
				</div>
			</div>
				<?php
			}
		}
	break;
	
	case 5:
		if ($model->deleteSlider($_POST['sliderId']))
		{
			echo 1;
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