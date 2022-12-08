window.onload = boot;

//URL absoluto
const SERVER_SIDE_URL = "http://localhost:88/webcalendar/results/results.json";

const ID_SECTION_EVENTS_RESULTS = "idSectionEventsResults";

var oSectionEventsResults;


function $ (pId){
    return window.document.getElementById(pId);
}//$

function bAllElementsOK(paRelevant){
    for (var o in paRelevant){
        var bOK = o!==null;
        if (!bOK) return false;
    }//for
    return true;
}//bAllElementsOK


function boot(){


    oSectionEventsResults = $(ID_SECTION_EVENTS_RESULTS);

    var oRelevant = [
        oSectionEventsResults
    ];

    var bAllOK = bAllElementsOK(oRelevant);
    if(bAllOK){
        //associar comportamentos aos objetos

        loadingEvents();
        console.log("All relevant object(s) OK!");
    }else{
        var strMsg = "Problem with 1+ object(s). Aborting.";
        console.log(strMsg);
        alert(strMsg);
        exit;
    }//else

}//boot



function loadingEvents(){

    ajaxRequest(
        SERVER_SIDE_URL,
        "GET",
        oSectionEventsResults
    );

   // oSectionEventsResults.innerHTML = "Please Wait! Loading Events..."; //TODO: trocar frase por .gif

    return false;

}//loadingEvents


function ajaxRequest(
    pUrl,
    pStrMethod,
    poContainerWhereToDisplayTheServerResponse
) {
    var req = new XMLHttpRequest();



    if (req!==null) {
        req.open(
            pStrMethod,
            pUrl,
            true
        );

        req.whereToDisplayResponse = poContainerWhereToDisplayTheServerResponse;

        //para controlo da maturidade do pedido
        req.onreadystatechange = responseToChangeInReqMaturity;

        req.send();
    }//if

}//ajaxRequest



function responseToChangeInReqMaturity(){
    console.log(this.readyState);
    switch (this.readyState){
        //last stage / response is ready
        case 4:

            switch (this.status) {
                case 200:
                case 304:
                    console.log("OK or Not Modified (cached)", this.status);
                    let data = JSON.parse(this.responseText);
                    //output
                    //TODO: passar output para uma function

                    mostrarResultados(data);

                    break;
                case 201:
                    console.log("Created", this.status);
                    break;
                case 403:
                    console.log("Not Authorized", this.status);
                    break;
                case 404:
                    console.log("Not Found", this.status);
                    break;
                case 500:
                    console.log("Server Side Error", this.status);
                    break;
                default:
                    console.log("Some other code: ", this.status, this.status);
            }




/*

            if (this.whereToDisplayResponse!==null){
                //this.whereToDisplayResponse.innerHTML = this.responseText; //JSON
                //this.responseXML; //XML
               /* var strHistogram = this.responseText;
                var oData = eval(strHistogram);
                drawGooglePieChart(
                    oData,
                    oSectionLogResults
                );
                if(this.status === 200 && this.status === 304){
                    try{
                        console.log("200 OK");
                        console.log(this.responseText);
                        let response = this.responseText;
                        if(response) {
                            try {
                                var a = JSON.parse(response);

                                alert(a.status);

                                a.forEach(item => {

                                    let p = document.createElement('p');
                                    let divMain = document.querySelector(this.whereToDisplayResponse);
                                    p.textContent = item.id + '  -  ' + item.name;

                                    divMain.appendChild(p);
                                });
                            } catch(e) {
                                alert(e); // error in the above string (in this case, yes)!
                            }
                        }
                        //let data = JSON.parse(this.responseText);

                        //tratar data
                        /*
                        data.forEach(item => {
                            let p = document.createElement('p');
                            p.textContent = item.id + '  -  ' + item.name;

                            this.whereToDisplayResponse.appendChild(p);
                        });



                        oSectionEventsResults.innerHTML +="Events Results <hr> <br>"+ this.responseText;
                    }catch (e) {
                        console.warn("Error in JSON. COuld not parse!");
                    }
                }else{
                    console.warn("Did not receive 200 OK from response!");
                }



                //opcional, para visualizar os dados de base
                //oSectionEventsResults.innerHTML +="Events Results <hr>"+this.responseText;

            }//if*/
            break;
        //cases 0,1,2,3 (response being built)
        default:
            break;
    }//switch
}//responseToChangeInReqMaturity


function mostrarResultados(pDataJson) {

    pDataJson.forEach(item => {

        let p = document.createElement('p');
        let btn = document.createElement('button');
        let divMain = document.querySelector('div');


        p.textContent = item.calendar_id + '  -  ' + item.summary + ' |    ' ;

        btn.textContent=" Ver Detalhes";
        btn.id = "idBtnVerDetalhes";
        btn.onclick= function (){
            alert("Start: " + item.start);
        };

        p.appendChild(btn);
        divMain.appendChild(p);

    });

}

