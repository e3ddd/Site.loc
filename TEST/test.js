// const withDefaultValue = (target, defaultValue = 0) => {
//     return new Proxy(target,{
//         get: (obj, prop) => (prop in obj ? obj[prop] : defaultValue)
//     })
// }
// const position = withDefaultValue(
//     {
//         x: 24,
//         y: 42,
//     }
// , 0);
//
// const withHiddenProperties = (target, prefix = "_") => {
//     return new Proxy(target,{
//         has: (obj, prop) => prop in obj && !prop.startsWith(prefix),
//         ownKeys: obj => Reflect.ownKeys(obj).filter(p => !p.startsWith(prefix)),
//         get: (obj, prop, receiver) => (prop in receiver ? obj[prop] : void 0),
//     })
// }
//
// let person = withHiddenProperties({
//     login: 'e3ddd',
//     _password: 'Stephan2002',
// }, '_');
//
//
// const IndexedArray = new Proxy(Array, {
//     construct(target,[args]){
//         const index = {};
//         args.forEach(item => (index[item.id] = item))
//
//         return new Proxy(new target(...args), {
//                 get(arr, prop){
//                     switch (prop){
//                         case 'push':
//                             return item => {
//                                 index[item.id] = item;
//                                 arr[prop].call(arr,item);
//                             }
//                         case 'findById':
//                             return id => index[id]
//
//                         default:
//                             return arr[prop]
//                     }
//                 }
//             })
//     }
// })
//
//
// const users = new IndexedArray([
//     {id: 1, name: 'Helen', job: 'Fullstack', age: 25},
//     {id: 3, name: 'George', job: 'PM', age: 24},
//     {id: 5, name: 'Peter', job: 'Admin', age: 32},
//     {id: 7, name: 'Robert', job: 'Manager', age: 40}
//     ]
// )
//
// let messages = [
//     {text: "Hello", from: "John"},
//     {text: "How goes?", from: "John"},
//     {text: "See you soon", from: "Alice"}
// ];
//
//

// const myGit = fetch('https://api.github.com/users/e3ddd');
// myGit
//     .then(data => data.json())
//     .then(list => console.log(list))
//     .catch(err => console.log(err));

// async function getGitData()
// {
//     try{
//         const response = await fetch('https://api.github.com/users/e3ddd');
//         const data = await response.json();
//         console.log(data)
//     }
//     catch(err)
//     {
//         console.log("Error >>>", err);
//     }
// }
//
// getGitData()

// async function sleep(time)
// {
//     return new Promise((resolve,reject) => {
//         time < 500 ? reject('Want more sleeping time !') : false;
//         setTimeout(() =>
//             resolve(`Sleeping time ${time} ms`)
//         , time)
//     });
// }
//
// const sleepSession = async () => {
//     try {
//     const sleep1 = await sleep(2000)
//         console.log(sleep1)
//         const sleep2 = await sleep(1500)
//         console.log(sleep2)
//         const sleep3 = await sleep(500)
//         console.log(sleep3)
//         const sleep4 = await sleep(200)
//         console.log(sleep4)
//     }
//     catch (err)
//     {
//     console.log("Error >>>", err)
//     }
// }
//
// sleepSession()
// sleep(2000)
//     .then(res => {
//     console.log(res)
//     return sleep(1000);
// })
//     .then(res => {
//     console.log(res)
//     return sleep(500)
// })
//     .then(res => {
//     console.log(res);
//     return sleep(200)
// })
//     .then(res => console.log(res))
//     .catch(err => console.log(err))


// function showTime(){
//     var date = new Date();
//     var h = date.getHours(); // 0 - 23
//     var m = date.getMinutes(); // 0 - 59
//     var s = date.getSeconds(); // 0 - 59
//     var session = "AM";
//
//     if(h == 0){
//         h = 12;
//     }
//
//     if(h > 12){
//         h = h - 12;
//         session = "PM";
//     }
//
//     h = (h < 10) ? "0" + h : h;
//     m = (m < 10) ? "0" + m : m;
//     s = (s < 10) ? "0" + s : s;
//
//     let time = h + ":" + m + ":" + s + " " + session;
//
//     $("#MyClockDisplay").text(time)
//
//     setTimeout(showTime, 1000);
//
// }
//
// showTime();


