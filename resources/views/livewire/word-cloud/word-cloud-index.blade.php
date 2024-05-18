<div>
    <section class="bg-white rounded-lg shadow">

    </section>
</div>

@script
    <script>
        let words = $wire.words;
        console.log(words);

        let colors = ["#166534", "#16A34A", "#f97316", "#059669", "#0369a1", "#9333ea", "#34D399", "#a21caf", "#d97706", "#0F766E", "#0D9488"];

        const width = 800;
        const height = 600;

        const svg = d3
            .select("section")
            .append("svg")
            .attr("width", width)
            .attr("height", height);

        const layout = d3.layout
            .cloud()
            .size([width, height])
            .words(words.map((word) => ({
                text: word.word,
                size: word.count * 50
            })))
            .padding(10)
            .rotate(0)
            .fontSize((d) => d.size)
            .spiral("rectangular")
            .on("end", draw);

        layout.start();

        function draw(words) {
            svg.selectAll("*").remove();

            svg
                .append("g")
                .attr("transform", `translate(${width/2}, ${height/2})`)
                .selectAll("text")
                .data(words)
                .enter()
                .append("text")
                .style("font-family", "Impact")
                .style("font-size", (d) => d.size * 1.05 + "px")
                // .style("font-weight", "bold")
                .style("fill", (d, i) => {
                    return colors[i % colors.length];
                })
                .attr("text-anchor", "middle")
                .attr("transform", (d) => `translate(${[d.x, d.y]})rotate(${d.rotate})`)
                .text((d) => d.text)
        }
    </script>
@endscript
