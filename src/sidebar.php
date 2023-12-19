<?php 
add_action("widgets_init", "register_sidebar_nwm");

function register_sidebar_nwm()
{
    register_sidebar([
        "name"=>"Pied de Page",
        "id"=>"sidebar-footer",
        "description"=>"Affiche des informations dans le footer"
    ]);
}

?>