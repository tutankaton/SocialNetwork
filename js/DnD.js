
var dragSrcEl = null;

function handleDragStart(e) {
  // Target (this) element is the source node.
  this.style.opacity = '0.5';
  	var str = this.innerHTML;

	if((str.substring(str.indexOf("<header>")+8, str.lastIndexOf("</header>"))!="trash")&&(str.substring(str.indexOf("<header>")+8, str.lastIndexOf("</header>"))!="file")){
	  dragSrcEl = this;
	
	  e.dataTransfer.effectAllowed = 'move';
	  e.dataTransfer.setData('text/html', this.innerHTML);
  
		this.classList.add('moving');
  }
}
function handleDragOver(e) {
  if (e.preventDefault) {
    e.preventDefault(); // Necessary. Allows us to drop.
  }
  if (e.stopPropagation) {
    e.stopPropagation(); // Stops some browsers from redirecting.
  }
  e.dataTransfer.dropEffect = 'move';  // See the section on the DataTransfer object.

  return false;
}

function handleDragEnter(e) {
  // this / e.target is the current hover target.
  this.classList.add('over');
}

function handleDragLeave(e) {
  this.classList.remove('over');  // this / e.target is previous target element.
}

function handleDrop(e) {
  // this/e.target is current target element.

  if (e.stopPropagation) {
    e.stopPropagation(); // Stops some browsers from redirecting.
  }
  if (e.preventDefault) {
    e.preventDefault(); // Necessary. Allows us to drop.
  }

  var str = this.innerHTML;
  var str2 = dragSrcEl.innerHTML;
  var indice = str.substring(str.indexOf("<header>")+8, str.lastIndexOf("</header>"));
  var indice2 = str2.substring(str2.indexOf("<header>")+8, str2.lastIndexOf("</header>"));
  // Don't do anything if dropping the same column we're dragging.

  if ((dragSrcEl != this)&&(indice!="trash")&&(indice!="file")&&(parseInt(indice)==indice)&&(parseInt(indice2)==indice2)) {
  	var str = this.innerHTML;
	var id1 = str.substring(str.indexOf("<header>")+8, str.lastIndexOf("</header>"));
	var str = dragSrcEl.innerHTML;
	var id2 = str.substring(str.indexOf("<header>")+8, str.lastIndexOf("</header>"));
  	$.ajax({
	  type: "POST",
	  url: "/socialNetwork/index.php/user/change_order/"+id1+"/"+id2,
	}).done(function( msg ) {

	});
    // Set the source column's HTML to the HTML of the columnwe dropped on.
    dragSrcEl.innerHTML = this.innerHTML;
    this.innerHTML = e.dataTransfer.getData('text/html');
  }else if ((dragSrcEl != this)&&(str.substring(str.indexOf("<header>")+8, str.lastIndexOf("</header>"))=="trash")) {
  	var str = dragSrcEl.innerHTML;
  	alert("eliminar "+str.substring(str.indexOf("<header>")+8, str.lastIndexOf("</header>")));
  }else if ((dragSrcEl != this)&&(str.substring(str.indexOf("<header>")+8, str.lastIndexOf("</header>"))=="file")) {
  	var str = dragSrcEl.innerHTML;
  	alert("archivar "+str.substring(str.indexOf("<header>")+8, str.lastIndexOf("</header>")));
  }
  
  dragSrcEl.style.opacity = '1';
  this.style.opacity = '1';
  [].forEach.call(cols, function (col) {
    col.classList.remove('over');
    col.classList.remove('moving');
  });
  	$('#projects-list .project').hover(function(){
		// on rollover
		$(this).children('.project-shadow').children('.project-thumbnail').children(".cover").stop().animate({ 
			top: "90"
		}, "fast");
	} , function() { 
		// on out
		$(this).children('.project-shadow').children('.project-thumbnail').children(".cover").stop().animate({
			top: "0" 
		}, "fast");
	});
	dragSrcEl = null;
  return false;
}

function handleDragEnd(e) {
  // this/e.target is the source node.
  this.style.opacity = '1';
  [].forEach.call(cols, function (col) {
    col.classList.remove('over');
    col.classList.remove('moving');
  });
  
}

var cols = document.querySelectorAll('#columns-full .column');
[].forEach.call(cols, function(col) {
  col.setAttribute('draggable', 'true');
  col.addEventListener('dragstart', handleDragStart, false);
  col.addEventListener('dragenter', handleDragEnter, false)
  col.addEventListener('dragover', handleDragOver, false);
  col.addEventListener('dragleave', handleDragLeave, false);
  col.addEventListener('drop', handleDrop, false);
  col.addEventListener('dragend', handleDragEnd, false);
});
