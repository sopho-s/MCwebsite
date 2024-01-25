function parse(line, inlist) {
    var text = "";
    if (line.charAt(0) == '*') {
        text = text + line.slice(1, line.length);
        if (inlist) {
            return "<li>" + text + "</li>";
        }
        return "(%)<ul>\n<li>" + text + "</li>";
    }
    if(line.charAt(line.length-1) == '/') {
        text = text + line.slice(0, line.length-1);
        text =  "<p>" + text + "</p>";
    } else if (line.charAt(0) == '!') {
        text = text + line.slice(line.indexOf("(") + 1, line.indexOf(")"));
        text = "<img class=\"blog\" src=\"photos/" + text + "\">";
    }
    if (inlist) {
        text = "(%)</ul>" + text;
    }
    return text;
}

function inputDoc(doc) {
    var inlist = false;
    var enddoc = "";
    for (var i = 0; i < doc.length; i++) {
        var line = doc[i];
        console.log(line);
        var line = parse(line, inlist);
        if (line.search("(%)") != -1) {
            console.log("removed");
            inlist = !inlist;
            line = line.replace("(%)", " ");
        }
        enddoc = enddoc + "\n" + line;
    }
    return enddoc;
}
