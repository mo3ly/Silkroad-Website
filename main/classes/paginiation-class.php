<?php
class Pagenation {
	 /* Pagination*/
	 Public function Pagination ($Page , $Url ,$Total)
	 {
		/** Show pagination if there is more than one page **/
		If ($Total > 1){
		
		If ($Page == 1 ){$StatusF = "disabled";}
		If ($Page == $Total ){$StatusL = "disabled";}
		$Prev = ($Page - 1);
		$Next = ($Page + 1);
		
		
	    echo'<div class="nk-pagination nk-pagination-left">';
		
		/** First page **/
		echo'<a href="'.$Url.'1" style ="color:olive" class="nk-pagination-prev '.$StatusF.'">
                <span class="nk-icon-arrow-left"></span>
             </a>';
	    /** Prev Page **/
		echo'<a href="'.$Url.''.$Prev.'" class="nk-pagination-prev '.$StatusF.'">
                <span class="nk-icon-arrow-left"></span>
             </a>';
		echo'<nav>';
		
		if(($Page-3)>0) {
				if($_GET["page"] == 1)
					echo'<a class="nk-pagination-current-white" href="'.$Url.'1">1</a>';
				else				
					echo'<a href="'.$Url.'1">1</a>';
			}
		
		if(($Page-3)>1) {
					echo '...';
			}
		
		for($i=($Page-2); $i<=($Page+2); $i++)	{
				if($i<1) continue;
				if($i>$Total) break;
				if($Page == $i)
					echo'<a class="nk-pagination-current-white" href="'.$Url.''.$i.'">'.$i.'</a>';
				else				
					echo'<a  href="'.$Url.''.$i.'">'.$i.'</a>';
			}
		
		
		if(($Total-($Page+2))>1) {
				echo '...';
			}
		
		echo'</nav>';
		
		/** Next Page **/
		echo'<a href="'.$Url.''.$Next.'" class="nk-pagination-next '.$StatusL.'">
                <span class="nk-icon-arrow-right"></span>
            </a>';
			
		/** Last Page **/
		echo'<a href="'.$Url.''.$Total.'" style="color:olive" class="nk-pagination-next '.$StatusL.'">
                <span class="nk-icon-arrow-right"></span>
            </a>';
		 
		echo'</div>';
		}
	}
	
	/* Pagination*/
	 Public function PaginationAjax ($Page , $Url ,$Total ,$Div ,$FuncName)
	 {
		echo'
		<script>
		function '.$FuncName.'(url){
			$("#'.$Div.'").html(" <h3><center>Loading please wait...</center></h3><br><span class=\'nk-preloader-animation\'></span>");
			$("#'.$Div.'").load("'.$Url.'"+url);
			}
		</script>';
		/** Show pagination if there is more than one page **/
		If ($Total > 1){
		
		If ($Page == 1 ){$StatusF = "disabled";}
		If ($Page == $Total ){$StatusL = "disabled";}
		$Prev = ($Page - 1);
		$Next = ($Page + 1);
		
		
	    echo'<div class="nk-pagination nk-pagination-left">';
		
		/** First page **/
		echo'<a onclick="'.$FuncName.'(1)" style ="color:olive" class="nk-pagination-prev '.$StatusF.'">
                <span class="nk-icon-arrow-left"></span>
             </a>';
	    /** Prev Page **/
		echo'<a onclick="'.$FuncName.'('.$Prev.')" class="nk-pagination-prev '.$StatusF.'">
                <span class="nk-icon-arrow-left"></span>
             </a>';
		echo'<nav>';
		
		if(($Page-3)>0) {
				if($_GET["page"] == 1)
					echo'<a style="cursor: pointer;" class="nk-pagination-current-white" onclick="'.$FuncName.'(1)">1</a>';
				else				
					echo'<a style="cursor: pointer;" onclick="'.$FuncName.'(1)">1</a>';
			}
		
		if(($Page-3)>1) {
					echo '...';
			}
		
		for($i=($Page-2); $i<=($Page+2); $i++)	{
				if($i<1) continue;
				if($i>$Total) break;
				if($Page == $i)
					echo'<a  style="cursor: pointer;" class="nk-pagination-current-white" onclick="'.$FuncName.'('.$i.')">'.$i.'</a>';
				else				
					echo'<a  style="cursor: pointer;" onclick="'.$FuncName.'('.$i.')">'.$i.'</a>';
			}
		
		
		if(($Total-($Page+2))>1) {
				echo '...';
			}
		
		echo'</nav>';
		
		/** Next Page **/
		echo'<a onclick="'.$FuncName.'('.$Next.')" class="nk-pagination-next '.$StatusL.'">
                <span class="nk-icon-arrow-right"></span>
            </a>';
			
		/** Last Page **/
		echo'<a onclick="'.$FuncName.'('.$Total.')" style="color:olive" class="nk-pagination-next '.$StatusL.'">
                <span class="nk-icon-arrow-right"></span>
            </a>';
		 
		echo'</div>';
		}
	}

}
?>