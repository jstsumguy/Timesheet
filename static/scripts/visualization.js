/* examples from Lynda.com */
/* creates a standard barchart */
function makeChart(div_id, limit)
{
    var bardata = [];
    var j;
    for(j=0; j < limit; j++)
    {
      bardata[j] = Math.floor((Math.random() * 8) + 1);
    }
    var height = 400,
        width = 894,
        barwidth = 50,
        baroffset = 5;

    var tempColor;

    var tooltip = d3.select('body').append('div')
        .style('positon', 'absolute')
        .style('padding', '0 10px')
        .style('background', 'white')
        .style('opacity', 0)

    var colors = d3.scale.linear()
        .domain([0, d3.max(bardata)])
        .range(['#fdff01', '#09ff01']);

    var yScale = d3.scale.linear()
        .domain([0, d3.max(bardata)])
        .range([0, (height - 10)]);

    var xScale = d3.scale.ordinal()
        .domain(d3.range(0, bardata.length))
        .rangeBands([0, width]);

      var barChart = d3.selectAll(div_id).append('svg')
        .attr('width', width)
        .attr('height', height)
        .append('g')
        .selectAll('rect').data(bardata)
        .enter().append('rect')
          .style('fill', colors)
          .attr('width', xScale.rangeBand())
          .attr('height', 0)
          .attr('id', function(d, i){return bardata[i];})
          .attr('x', function(d, i){
            return xScale(i);
          })
          .attr('y', height)

          //Mouse over
          .on('mouseover', function(d){
            tooltip.transition()
              .style('opacity', .9)
              tempColor = this.style.fill;
              d3.select(this)
              .style('fill', '#B319AB')
            //tooltip.html(d)
            //console.log('Mouse over');
          })

          .on('mouseout', function(d){
            d3.select(this)
              .style('fill', tempColor)
          })

          barChart.transition().delay(function(d, i){
            return i * 35;
          }).duration(1900)
            .attr('height', function(d){
            return yScale(d);
          })
            .attr('y', function(d){
              return height - yScale(d);
            })
            .ease('elastic')

    /* D3 Axis */

    // var vGuideScale = d3.scale.linear()
    //     .domain([0, d3.max(bardata)])
    //     .range([height, 0])
    // var vAxis = d3.svg.axis()
    //     .scale(vGuideScale)
    //     .orient('left')
    //     .ticks(10)

    // var vGuide = d3.select('svg').append('g')
    //     vAxis(vGuide)
    //     vGuide.attr('transform', 'translate(35, 10)')
    //     vGuide.selectAll('path')
    //       .style({fill: 'none', stoke: "#000"})
    //     vGuide.selectAll('line')
    //       .style({stroke: "#000"})

    // var hAxis = d3.svg.axis()
    //     .scale(xScale)
    //     .orient('bottom')
    //     .tickValues(xScale.domain().filter(function(d, i){ return !(i % (bardata.length/5))}));

    // var hGuide = d3.select('svg').append('g')
    //     hAxis(hGuide);
    //     hGuide.attr('transform', 'translate(0, ' + (height - 30) + ')');
    //     hGuide.selectAll('path')
    //       .style({fill: 'none', stoke: "#000"})
    //     hGuide.selectAll('line')
    //       .style({stroke: "#000"})
}
