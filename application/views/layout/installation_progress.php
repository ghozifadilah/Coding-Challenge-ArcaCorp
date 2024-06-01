<div class="container-fluid">
    <div class="row bs-wizard" style="border-bottom:0;margin-top: 0;">

        <div class="col-xs-4 bs-wizard-step <?php echo ($install_step>1)?'complete':(($install_step==1)?'active':'disabled')?>">
            <div class="text-center bs-wizard-stepnum">Langkah 1</div>
            <div class="progress"><div class="progress-bar progress-bar-striped"></div></div>
            <a href="#" class="bs-wizard-dot"></a>
            <div class="bs-wizard-info text-center">Install Coordinator</div>
        </div>

        <div class="col-xs-4 bs-wizard-step <?php echo ($install_step>2)?'complete':(($install_step==2)?'active':'disabled')?>">
            <div class="text-center bs-wizard-stepnum">Langkah 2</div>
            <div class="progress"><div class="progress-bar"></div></div>
            <a href="#" class="bs-wizard-dot"></a>
            <div class="bs-wizard-info text-center">Install Lampu</div>
        </div>

        <div class="col-xs-4 bs-wizard-step <?php echo ($install_step>3)?'complete':(($install_step==3)?'active':'disabled')?>">
            <div class="text-center bs-wizard-stepnum">Langkah 3</div>
            <div class="progress"><div class="progress-bar"></div></div>
            <a href="#" class="bs-wizard-dot"></a>
            <div class="bs-wizard-info text-center">Selesai</div>
        </div>

    </div>  
</div>