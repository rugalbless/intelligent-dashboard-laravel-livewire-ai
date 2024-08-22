export default () => ({
    loading: false,
    generateReport() {
        this.loading = true;

        const sizes = this.$refs.vegalitecontainer.getBoundingClientRect();

        this.$wire.generateReport()
            .then((result) => {
                if (!result) {
                    throw new Error('Nenhum resultado retornado do servidor.');
                }

                var dataset = this.$wire.get('dataset');

                // Garantir que 'result' seja um objeto antes de definir propriedades nele
                if (typeof result === 'object') {
                    result.data = dataset;
                    result.height = sizes.height;
                    result.width = sizes.width;

                    console.log(dataset, result, sizes);

                    window.vegaEmbed("#vis", result);
                } else {
                    console.error('Resultado inesperado:', result);
                }

                this.loading = false;
            })
            .catch((err) => {
                this.loading = false;
                console.error('Erro:', err);
            })
    }
})
