(function () {
    window.SS = window.SS || {};
    SS.Require = function (callback) {
        if (typeof callback === "function") {
            if (window.SS && SS.EventTrack) {
                callback();
            } else {
                var siteSpect =
                    document.getElementById("siteSpectLibraries");
                var head = document.getElementsByTagName("head")[0];
                if (
                    siteSpect === null &&
                    typeof head !== "undefined"
                ) {
                    siteSpect = document.createElement("script");
                    siteSpect.type = "text/javascript";
                    siteSpect.src =
                        "/__ssobj/core.js+ssdomvar.js+generic-adapter.js";
                    siteSpect.async = true;
                    siteSpect.id = "siteSpectLibraries";
                    head.appendChild(siteSpect);
                }
                if (window.addEventListener) {
                    siteSpect.addEventListener(
                        "load",
                        callback,
                        false
                    );
                } else {
                    siteSpect.attachEvent(
                        "onload",
                        callback,
                        false
                    );
                }
            }
        }
    };
})();

let mappa = document.getElementById('mappa');
var options = {
    searchOptions: {
        key: "rSkxFlbVNJrDJk4qCwxbY0Z0qN6UEcFu",
        language: "en-GB",
        limit: 5,
    },
    autocompleteOptions: {
        key: "rSkxFlbVNJrDJk4qCwxbY0Z0qN6UEcFu",
        language: "en-GB",
    },
};
var ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
var searchBoxHTML = ttSearchBox.getSearchBoxHTML();
mappa.append(searchBoxHTML);





