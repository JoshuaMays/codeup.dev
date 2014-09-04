// Initialize timeoutId as global var
var timeoutId;
function save() {
            alert('Saved!');
        }

function autosave() {
    var timer = 5000;
    
    // When multiple autosave() calls are made, clear the previous timeout
    clearTimeout(timeoutId);
    // Set a 5 second timeout function that calls save()
    timeoutId = setTimeout(save, timer);
}

var textarea = document.getElementById('important');
textarea.addEventListener('keyup', autosave, false);

