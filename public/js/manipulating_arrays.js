// todo:
// Create an array holding the names of the planets of our solar system (in order, starting closest to the sun).
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
// todo: Do what the log statement above says you will do.
planets.unshift('The Sun');
logPlanets();

console.log('Adding "Pluto" to the end of the planets array.');
// todo: Do what the log statement above says you will do.
planets.push('Pluto');
logPlanets();

console.log('Removing "The Sun" from the beginning of the planets array.');
// todo: Do what the log statement above says you will do.
planets.shift();
logPlanets();

console.log('Removing "Pluto" from the end of the planets array.');
// todo: Do what the log statement above says you will do.
planets.pop();
logPlanets();

console.log('Finding and logging the index of "Earth" in the planets array.');
// todo: Do what the log statement above says you will do.
var earthIndex = planets.indexOf('Earth');
console.log('Earth is at index: ' + earthIndex);
console.log('~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~');


console.log('Using splice to remove the planet after Earth.');
// todo: Do what the log statement above says you will do.
var splicedPlanet = planets.splice(earthIndex + 1,1)
logPlanets();

console.log('Using splice to add back the planet after Earth.');
// todo: Do what the log statement above says you will do.
planets.splice(earthIndex + 1, 0, splicedPlanet[0]);
logPlanets();

console.log('Reversing the order of the planets array.');
// todo: Do what the log statement above says you will do.
planets.reverse();
logPlanets();

console.log('Sorting the planets array.');
// todo: Do what the log statement above says you will do.
planets.sort();
logPlanets();