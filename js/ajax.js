/* FUNCIONES AJAX */

/* FUNCION createXMLHttpRequestObject() - Creacion de una instancia XMLHttpRequest
 */
	function createXMLHttpRequestObject() {
	var aVersions = [ "MSXML2.XMLHttp.5.0", "MSXML2.XMLHttp.4.0","MSXML2.XMLHttp.3.0", "MSXML2.XMLHttp","Microsoft.XMLHttp"];
	if (window.XMLHttpRequest){
	// para IE7, Mozilla, Safari, etc: que usen el objeto nativo
	return new XMLHttpRequest();
	}
	else if (window.ActiveXObject){
	// de lo contrario utilizar el control ActiveX para IE5.x y IE6.x
		for (var i = 0; i < aVersions.length; i++) {
		try {
		var oXmlHttp = new ActiveXObject(aVersions[i]);
		return oXmlHttp;
		}
		catch (error)	{
	//no necesitamos hacer nada especial
				}
			}
		}
	}

/* FUNCION getXMLDOMObject(xmlFileName)
 RecuperaciÃ³n de un documento XML desde el servidor y devoluciÃ³n de un
 objeto DOM (El objeto XMLHttpRequest se ha creado y representado
 mediante la variable oXMLHttpObject
 */
function getXMLDOMObject(xmlFileName){
    oXMLHttpObject.open('GET', xmlFileName);
    oXMLHttpObject.onreadystatechange = function(){
        if (oXMLHttpObject.readyState == 4) {
            if (XMLHttpObject.status == 200) {
                oXMLDOMObject = oXMLHttpObject.responseXML;
            }
            else {
                alert("There was a problem with the request.");
            }
        }
        XMLHttpObject.send(null);
    }
}

/* FUNCION removeWhiteSpace()
 Elimina nodos vacios de un objeto DOM pasado por parametro
 */

function removeWhiteSpace(xmlDOM){
    var notWhitespace = /\s/;
    var i;
    for (i = 0; i < xmlDOM.childNodes.length; i++) {
        var currentNode = xmlDOM.childNodes[i];
        if (currentNode.nodeType == 1) {
            removeWhiteSpace(currentNode);
        }
        if ((notWhitespace.test(currentNode.nodeValue)) &&
        (currentNode.nodeType == 3)) {
            xmlDOM.removeChild(xmlDOM.childNodes[i--]);
        }
    }
    return xmlDOM;
}
