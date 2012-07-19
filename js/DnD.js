
var dragSrcEl = null;

function handleDragStart(e) {
  // Target (this) element is the source node.
  this.style.opacity = '0.5';

  dragSrcEl = this;

  e.dataTransfer.effectAllowed = 'move';
  e.dataTransfer.setData('text/html', this.innerHTML);
  
   this.classList.add('moving');
}
function handleDragOver(e) {
  if (e.preventDefault) {
    e.preventDefault(); // Necessary. Allows us to drop.
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
var str = this.innerHTML;
var id1 = str.substring(str.indexOf(">")+1, str.lastIndexOf("<"));
var str = dragSrcEl.innerHTML;
var id2 = str.substring(str.indexOf(">")+1, str.lastIndexOf("<"));

  // Don't do anything if dropping the same column we're dragging.
  if (dragSrcEl != this) {
  	$.ajax({
	  type: "POST",
	  url: "/socialNetwork/index.php/user/change_order/"+id1+"/"+id2,
	}).done(function( msg ) {

	});
    // Set the source column's HTML to the HTML of the columnwe dropped on.
    dragSrcEl.innerHTML = this.innerHTML;
    this.innerHTML = e.dataTransfer.getData('text/html');
  }

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
