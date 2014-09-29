// INITIALIZE timeoutId AS GLOBAL VAR
var timeoutId;

// CALL AUTOSAVE FUNCTION ON KEYUP EVENT
var textarea = $('#important').keyup(autosave);

function save() {
            alert('Saved!');
        }

function autosave() {
    var timer = 5000;
    
    // WHEN MULTIPLE autosave() CALLS ARE MADE, CLEAR PREVIOUS TIMEOUT
    clearTimeout(timeoutId);
    
    // SET A 5 SECOND TIMEOUT FUNCTION THAT CALLS save()
    timeoutId = setTimeout(save, timer);
}

