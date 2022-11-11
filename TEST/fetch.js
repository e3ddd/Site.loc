const requestUrl = "https://jsonplaceholder.typicode.com/users";

function sendRequest(method, requestUrl,body = null)
{
    const headers = {
        'Content-Type': 'application/json',
    }
    return fetch(requestUrl, {
        method: method,
        body: JSON.stringify(body),
        headers: headers,
    }).then(response => {
        return response.json();
    })
}

// sendRequest('GET', requestUrl, "json")
//     .then(data => console.log(data))
//     .catch(err => console.log(err));

// let lena = {
//     name: 'Helen',
//     age: 25,
// }
//
// sendRequest('POST', requestUrl, lena)
//     .then(data => console.log(data))
//     .catch(err => console.log(err));