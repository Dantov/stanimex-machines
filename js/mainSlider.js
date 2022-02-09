var slidr_wrapp = document.getElementById('slidr');

var currentSlide = randomInteger(0, 7);
slidr_wrapp.classList.add('slide' + currentSlide);

var slideInterval = setInterval(nextSlide, 4000);

function nextSlide(){
    goToSlide(currentSlide+1);
};
function previousSlide(){
    goToSlide(currentSlide-1);
};
function goToSlide(n){
	
	currentSlide = (n+8)%8;
    slidr_wrapp.className = 'slidr slide' + currentSlide;
	
};


var playing = true;
var pauseButton = document.getElementById('pause');

function pauseSlideshow(){
    pauseButton.innerHTML = '&#9658;'; // play character
    playing = false;
    clearInterval(slideInterval);
}

function playSlideshow(){
    pauseButton.innerHTML = '&#10074;&#10074;'; // pause character
    playing = true;
    slideInterval = setInterval( nextSlide, 4000 );
}

pauseButton.onclick = function(){
    if ( playing ) {
    	pauseSlideshow(); 
	} else {
    	playSlideshow(); 
	}
};

var next = document.getElementById('next');
var previous = document.getElementById('previous');

next.onclick = function(){
    pauseSlideshow();
    nextSlide();
};
previous.onclick = function(){
    pauseSlideshow();
    previousSlide();
};


/*
function topSlideGo() {
	playing = true;
	
	while ( true ) {
		next = randomInteger(1, 8);
		if ( next != curent ) break;
	}

	var cls = 'slide';
	
	var cls_curent = cls + curent;
	var cls_next = cls + next;
	
	globalwrapper.classList.remove(cls_curent);
	globalwrapper.classList.add(cls_next);
	curent = next;
    };
	
function topSlidePause() {
	
pauseButton.innerHTML = 'Play';
playing = false;
clearInterval(timerId);

};

pauseButton.onclick = function() {

if(playing) {

topSlidePause();

} else {

timerId = setInterval(topSlideGo, 2000);

}

};
  */
function randomInteger(min, max) {
    var rand = min - 0.5 + Math.random() * (max - min + 1)
    rand = Math.round(rand);
    return rand;
  }

  
  