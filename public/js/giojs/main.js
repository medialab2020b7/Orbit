$(function() {
    const container = document.getElementById( "globeArea" );

    let data = [];

    const makeController = () => {
        var configs = {
            control: {
                stats: false,
                disableUnmentioned: false,
                lightenMentioned: false,
                inOnly: false,
                outOnly: false,
                initCountry: "PT",
                halo: true
            },
            color: {
                    surface: 0xFFFFFF,
                    selected: null,
                    in: 0x154492,
                    out: 0xDD380C,
                    halo: 0xFFFFFF,
                    background: null
            },
            brightness: {
                    ocean: 0.5,
                    mentioned: 0.5,
                    related: 0.5
            }
        };

        return new GIO.Controller( container, configs );
    };

    const clearData = () => {
        data = [];
    };

    const addConnection = (e, i, v ) => {
        data.push({e,i,v});
    };

    const fetchHistories = () => axios.get('/api/histories').then(response => {
        //console.log("Loaded histories"); console.log(response); console.log(response.data);  //Testing
        let histories = response.data;

        histories.forEach(h => {
            let connections = h.histories;
            connections.forEach(c => {
                // addConnection();
                //console.log(c);
            });
        });

            //TODO - get cities and countries info with the history info. (maybe use a mutator?)

        clearData();

    }).catch(err => {
        console.log("ERROR loaded histories");  //Testing
        console.log(err);
        if (err.response) console.log(err.response);
        else if (err.request) console.log(err.request);
    });

    let controller = makeController();
    controller.setInitCountry("PT");
    controller.init();

    fetchHistories();
});
