<style type="text/css">
.glyphicon-refresh-animate {
    -animation: spin .7s infinite linear;
    -webkit-animation: spin2 .7s infinite linear;
}
@-webkit-keyframes spin2 {
    from { -webkit-transform: rotate(0deg);}
    to { -webkit-transform: rotate(360deg);}
}
@keyframes spin {
    from { transform: scale(1) rotate(0deg);}
    to { transform: scale(1) rotate(360deg);}
}
table.scrollable {
    width: auto;
}
table.scrollable thead {
    display: block;
}
table.scrollable tbody {
    display: block;
    height: 400px;
    overflow-y: auto;
    overflow-x: hidden;
}
</style>