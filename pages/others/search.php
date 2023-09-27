<div class="nk-gap-5"></div>
<center>
    <h1>Live Search!!!</h1>
    <p style="color:olive">Your way to find, what is in your mind!</p>
</center>
<div class="nk-gap-3"></div>

<div class="container">

<div class="col-md-8 offset-md-2">
                   
            <form id="SearchForm" onsubmit="SearchAction();return false;" method="POST">
			
			        <div class="col-md-4">
				    <select class="form-control" name="type">
					<option value="char" name="char">Character</option>
					<option value="guild" name="guild">Guild</option>
					</select>
					</div>
					
					<div class="hidden-lg-up hidden-md-up">
					<div class="nk-gap-2"></div>
					</div>
					
					<div class="col-md-8">
                    <input type="text" class="form-control" onkeyup="SearchAction();" name="search" id="search" placeholder="Search..." >
					<input type="submit" style="display:none" /></div>
					
				<div class="nk-gap-5"></div>
				
				<div class="col-md-12">
				<div id="searchbox">
				<h4><b class="fa fa-search"></b> Your search results will be listed here.<h4>
				</div>
				</div>
            </form>
			
</div>


</div>
<div class="nk-gap-6"></div>
<div class="nk-gap-2"></div>