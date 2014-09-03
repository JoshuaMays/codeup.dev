var timeoutId;
function save() {
            alert('Saved!');
        }

function autosave() {

// todo:
// Use setTimeout and clearTimeout within this function
// so that the save() function is called 5 seconds after
// the last key up event. If a new key up event occurs,
// you need to cancel the existing timer and set a new one.
    clearTimeout(timeoutId);
    timer = 5000;
    timeoutId = setTimeout(save, timer);
}
// don't modify the line below
// this causes the autosave function to be called whenever
// a key up event occurs in the textarea
// we will learn about events in the DOM lessons
var textarea = document.getElementById('important');
textarea.addEventListener('keyup', autosave, false);

