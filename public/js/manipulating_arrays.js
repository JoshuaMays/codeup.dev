// Create an array holding the names of the planets of our solar system
var planets = ['Mercury', 'Venus', 'Earth', 'Mars', 'Jupiter', 'Saturn', 'Uranus', 'Neptune'];

// function for logging the planets array
function logPlanets() {
    console.log('Here is the list of planets:');
    planets.forEach(function (planet, key, planets) {
        console.log(key + ' ' + planet);
    });
    console.log('~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~');
    
}

console.log('Adding "The Sun" to the beginning of the planets array.');
// Add The Sun to the beginning of planets array.
planets.unshift('The Sun');
logPlanets();

console.log('Adding "Pluto" to the end of the planets array.');
// Add Pluto to the end of the planets array.
planets.push('Pluto');
logPlanets();

console.log('Removing "The Sun" from the beginning of the planets array.');
// Shift off The Sun from the beginning of the array.
planets.shift();
logPlanets();

console.log('Removing "Pluto" from the end of the planets array.');
// Pop off Pluto from the end of the planets array.
planets.pop();
logPlanets();

console.log('Finding and logging the index of "Earth" in the planets array.');
// Capture the index of "Earth".
var earthIndex = planets.indexOf('Earth');
console.log('Earth is at index: ' + earthIndex);
console.log('~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~');


console.log('Using splice to remove the planet after Earth.');
// Splice out the planet after earthIndex. Capture removed planet to var.
var splicedPlanet = planets.splice(earthIndex + 1,1)
logPlanets();

console.log('Using splice to add back the planet after Earth.');
// Splice the planet back in again.
planets.splice(earthIndex + 1, 0, splicedPlanet[0]);
logPlanets();

console.log('Reversing the order of the planets array.');
// Reverse the array elements.
planets.reverse();
logPlanets();

console.log('Sorting the planets array.');
// Sort the array alphabetically.
planets.sort();
logPlanets();
