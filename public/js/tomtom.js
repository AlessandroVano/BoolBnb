let inputAddress = document.getElementById('address');
let searchbar = document.getElementById('searchbar')
let inputLatitude = document.getElementById('latitude')
let inputLongitude = document.getElementById('longitude')
let list = document.getElementById('list')
let array = [];


inputAddress.addEventListener('keyup', getGps);

function getGps(){
    let li = document.getElementsByTagName('li');


    while (li.length > 0) {

    // New JS remove Function
    li[0].remove();
    }
    let query = inputAddress.value
    axios.get(`https://api.tomtom.com/search/2/search/${query}.json?key=Y2IIAoAdWKhX1tzkK6euoDxhJkGubCd9&limit=5`)
    .then((res) => {
        array = res.data.results
        console.log(array)
        //creare array di suggerimenti

        array.forEach((item) => {
            let latitude = item.position.lat
            let longitude = item.position.lon
            //stampare array suggerimenti
            const testo = item.address.freeformAddress
            const contenitore = document.createElement('li');
            contenitore.classList.add('suggestions')
            list.appendChild(contenitore)
            contenitore.innerHTML = testo
            
            //settare il value dell input al click
            function setValue(){
                inputAddress.value = contenitore.innerText
                inputLatitude.value = latitude
                inputLongitude.value = longitude
                while (li.length > 0) {

                    // New JS remove Function
                    li[0].remove();
                    }
            }
            contenitore.addEventListener('click', setValue)
        })
    });
}