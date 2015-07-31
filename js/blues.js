var mouse_up = true;
var offset = 10;
var x = 0;
var y = 0;

function enable_tracking(){
	$("input[name='img']").keypress(search_bar_key_press);
	$("img#display").mousemove(track_mouse);
	$("img#display").mouseup(set_mouse_up);
	$("img#display").mousedown(set_mouse_down);
}

function get_image_link(){
	input_link = $("input[name='img']")[0].value;
	populate_image(input_link);
	return input_link;
}

function search_bar_key_press(event){
	if(event.charCode==13) get_image_link();
}

function populate_image(input_link){
	image = $("img#display")[0];
	image.src    = input_link;
}

function track_mouse(event){
  paw   = $("img#paw")[0];
  image = $("img#display")[0];
  if(!mouse_up){
	  paw.style.top  = ( event.pageY + offset )+ "px";
	  paw.style.left = ( event.pageX + offset )+ "px";
	  x = event.pageX;
	  y = event.pageY;
	  refresh_permalink();
  }
}

function set_mouse_up(){
	mouse_up = true;
	console.log("mouse is up");
}

function set_mouse_down(){
	mouse_up = false;
	console.log("mouse is down");
}

function refresh_permalink(){
	permalink = $("a#permalink")[0];
	image_link = get_image_link();
	shoe = $("input[name='shoe']")[0];
	
	link = "http://ijtaba.me.uk/bluesclues/display.html?img="+image_link+"&x="+x+"&y="+y+"&shoe="+shoe.checked;
	permalink.href = link;
	permalink.innerText = link;
}

function place_paw(){
	x    = urlParam("x");
	y    = urlParam("y");
	img  = urlParam("img");
	shoe = urlParam("shoe");
	
	$("img#display")[0].src = img;
	paw = $("img#paw")[0];
	paw.style.top  = (Number(y) + offset) + "px";
	paw.style.left = (Number(x) + offset) + "px";
	audio = $("div#audio")[0];
	
	if(shoe=="true"){
		audio.innerHTML='<embed id="audio" width="0px" height="0px" src="audio/my_shoe.wav">';
	}
	else{
		audio.innerHTML='<embed id="audio" width="0px" height="0px" src="audio/a_clue.wav">';
	}
}
//https://stackoverflow.com/questions/19491336/get-url-parameter-jquery
function urlParam(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
       return null;
    }
    else{
       return results[1] || 0;
    }
}