const select = document.querySelector("select")
const main = document.querySelector("main") 

const xhr = new XMLHttpRequest()
xhr.open("GET", "http://localhost/RestfulPOO/rest_blog/api/categoria/read.php");
xhr.send();
xhr.onreadystatechange=function() {
    if(this.readyState == 4 && this.status == 200) {
        console.log(xhr.responseText);
        var dados = JSON.parse(xhr.responseText);
        for (i=0; i<dados.length;i++){
            var option = document.createElement("option");
            var txt = document.createTextNode(dados[i].nome);
            option.setAttribute("value", dados[i].id)
            option.appendChild(txt);
            select.appendChild(option);
        }
    }
}

select.addEventListener('change', ev => {
    alert(select.value)
    getPosts(null,select.value)
    // const xhr = new XMLHttpRequest()
    // xhr.open("GET", "http://localhost/RestfulPOO/rest_blog/api/post/read.php")
    // xhr.send()
    // xhr.onreadystatechange=function() {
    //     if(this.readyState == 4 && this.status == 200) {
    //         console.log(xhr.responseText);
    //     }
    // }
})

async function getPosts(id,idcategoria){
    let url="http://localhost/RestfulPOO/rest_blog/api/post/read.php"
    if(id!=null){
        url+='?id='+id
    }else if(idcategoria!=null){
        url+='?idcategoria='+idcategoria
    }
    const request = await fetch(url)
    const resposta = await request.json()
    resposta.forEach(post => {
        const div = document.createElement("div")
        const h1 = document.createElement("h1")
        const p = document.createElement("p")
        h1.innerText = post.titulo
        p.innerText=post.texto
        div.appendChild(h1)
        div.appendChild(p)
        main.appendChild(div)
    });
}