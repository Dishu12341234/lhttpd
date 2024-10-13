let fileWrappers = (document.getElementById('files').children);
for (let index = 0; index < fileWrappers.length; index++) {
    const element = fileWrappers[index];
    element.onclick = () => {
    let filepath = `/preview/${element.children[1].innerText}`;
    console.log(filepath);
    
    window.location.replace(filepath);
    }
}

let uploadstats = document.getElementById('uploadStats')
if(uploadstats.innerText == 'ups')
{
    window.location.replace(window.location.pathname)
}

let uplaoder = document.getElementById('finp')
let uploadButton = document.getElementById('filesd')
uplaoder.addEventListener("input",()=>{uploadButton.click()})