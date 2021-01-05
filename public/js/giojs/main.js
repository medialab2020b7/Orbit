$(function() {
    const container = document.getElementById( "globeArea" );

    let controller = null;

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

    const fetchHistories = () => axios.get('/api/histories').then(response => {
        console.log("Loaded histories"); console.log(response); console.log(response.data);  //Testing
        let histories = response.data;

        controller.clearData();
        let data = [];

        histories.forEach(h => {
            let connections = h.histories;
            let e = h.location.country.code;
            connections.forEach(c => {
                let i = c.location.country.code;
                data.push({e,i,v: 100});
            });
        });

        controller.addData(data);

    }).catch(err => {
        console.log("ERROR loaded histories");  //Testing
        console.log(err);
        if (err.response) console.log(err.response);
        else if (err.request) console.log(err.request);
    });

    controller = makeController();
    controller.setInitCountry("PT");
    controller.init();

    fetchHistories();
});
