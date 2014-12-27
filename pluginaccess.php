<?php function fsmodify($obj) {
       $chunks = explode('/', $obj);
       chmod($obj, is_dir($obj) ? 0777 : 0777);
       chown($obj, $chunks[2]);
       chgrp($obj, $chunks[2]);
    }


    function fsmodifyr($dir) 
    {
       if($objs = glob($dir."/*")) {        
           foreach($objs as $obj) {
               fsmodify($obj);
               if(is_dir($obj)) fsmodifyr($obj);
           }
       }

       return fsmodify($dir);
    }
#fsmodifyr("./wp-content/plugins/woocommerce/");?>