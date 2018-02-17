<meta name="viewport" content="width=device-width, initial-scale=1">
<style>


.img-structure{
  width:32px;
  height: 32px;
  position: relative;
  top: -5px;
}

.img-rounded{
  border-radius: 50%;
}


.modal-header, h4, .close {
    color:white !important;
    text-align: center;
    font-size: 30px;
}


@media(min-width: 992px){
    nav.navbar{
        top:0px;
    }

    #photo-upload-modal .modal-dialog {
      width: 900px;
      margin: 30px auto;
    }
}



@media (min-width:768px){
  .mobile{
    display: none;
  }

  .desktop{
    display: inline;
  }
}
@media (max-width:767px){
  .mobile{
    display: inline;
  }

  .desktop{
    display: none !important; /*important, as the image would display on the collapse dropdown as well*/
  }
}

@media (min-width:768px) and (max-width:991px){
    #photo-upload-modal .modal-dialog {
      width: 700px;
      margin: 30px auto;
    }
}

</style>

<body class="theme-red">
    <!-- Page Loader 
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Aguarde um momento...</p>
        </div>
    </div>
	
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="DIGITE SUA PESQUISA...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                				
				<a class="navbar-brand"><i class="material-icons">email</i></a>
				<a class="navbar-brand" href="home.php?acao=welcome">emerj.virtual@tjrj.jus.br |</a>
				  
				<a class="navbar-brand"><i class="material-icons">phone</i></a>
				<a class="navbar-brand" href="home.php?acao=welcome">(21) 3133-1880 | </a>	
				
				<a class="navbar-brand"><i class="material-icons">headset_mic</i></a>
				<a class="navbar-brand" href="home.php?acao=welcome">Horário de atendimento: 10:00h às 18:00h</a>	
				
			</div>
			
							

            <div class="collapse navbar-collapse" id="navbar-collapse">
            				
				
				<ul class="nav navbar-nav navbar-right">					
					  <li class="desktop"><a href="#">
						  <?php	
								
							  $image = "../images/user.png";
							
						  ?>
						  <img src=<?php echo $image ?>  alt="profile photo" class="profile-photo img-structure img-rounded"/>
					  </a>
					  </li>
					   
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">                                        
                                        <li><a href="home.php?acao=deslogar">Sair do Sistema</a></li>
                                    </ul>
                                </li>
                            
					  
					  
					  
				</ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
	
	
	
  <!-- Photo upload Modal -->
  <div class="modal fade" id="photo-upload-modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header background-maroon" style="padding:35px 50px;color:white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-camera"></span> Upload Photo</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
              <?php include 'imagem-perfil-aluno/photo_crop.html';?>
        </div>
      </div>
      
    </div>
  </div>

</div>
 

	<script>
	$(document).ready(function(){

		$("#profile-photo").on('click',function(){
		  $('#photo-upload-modal').modal();
		});
	});
	</script>
	
	
	
	
	
	
	
	