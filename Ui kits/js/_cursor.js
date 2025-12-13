const mouseCursor = document.querySelector('.cursor__outline');
const mouseCursorDot = document.querySelector('.cursor__dot');

// cursor
window.addEventListener('mousemove', cursor);

function cursor(e) {
  mouseCursor.style.top = `${e.pageY}px`;
  mouseCursor.style.left = `${e.pageX}px`;
  mouseCursorDot.style.top = `${e.pageY}px`;
  mouseCursorDot.style.left = `${e.pageX}px`;
  mouseCursor.style.scale = '1';
  mouseCursorDot.style.scale = '1';
}
