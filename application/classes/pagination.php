<?php
    class Pagination {
        public function tampilkan($url, $currentPage,$totalPages)
        {   
            echo "<ul class='pagination pagination-md no-margin pull-right'>";
                if (isset($totalPages)) {
                    echo "<li><a href='".base_url('/kelola/'.$url.'/page/1')."'>&Lang;</a></li>";

                    if ($currentPage>1) {
                        echo "<li><a href='".base_url('/kelola/'.$url.'/page/'.($currentPage-1))."'>&lang;</a></li>";
                    } else {
                        echo "<li><a href='".base_url('/kelola/'.$url.'/page/'.($currentPage))."'>&lang;</a></li>";
                    }
                    
                    for ($i=$currentPage-3; $i < $currentPage+3; $i++) {
                        //echo $i;
                        if($i>0&&$i<=$totalPages){
                            if ($i==$currentPage) {
                                echo "<li class='active'><a href='".base_url('/kelola/'.$url.'/page/'.$i)."'>$currentPage</a></li>";
                            } else {
                                echo "<li><a href='".base_url('/kelola/'.$url.'/page/'.$i)."'>$i</a></li>";
                            }
                            if($i<1){
                                echo "<li><a href='".base_url('/kelola/'.$url.'/page/'.($i+6))."'>($i+6)</a></li>";
                            }
                        }
                    }
                    
                    if($i-4==$totalPages){
                        echo "<li><a href='".base_url('/kelola/'.$url.'/page/'.$totalPages)."'>$totalPages</a></li>";
                    }
                    
                    if ($currentPage<$totalPages) {
                        echo "<li><a href='".base_url('/kelola/'.$url.'/page/'.($currentPage+1))."'>&rang;</a></li>";
                    } else {
                        echo "<li><a href='".base_url('/kelola/'.$url.'/page/'.($currentPage))."'>&rang;</a></li>";
                    }
                    echo "<li><a href='".base_url('/kelola/'.$url.'/page/'.($totalPages))."'>&Rang;</a></li>";
                }
            echo "</ul>";
        }
    }
?>