const fs = require('fs');
const ejs = require('ejs');


//テンプレ作成
let template = "// Automatically generated by ./convert_to_scss.js\n\n$skin-name: \"<%- skin_name -%>\";\n$skin-colors: (<%- editor_colors -%>);\n$skin-gradients: (<%- skin_gradients -%>);\n$skin-font-sizes: (<%- skin_font_sizes -%>);";

// ./src/skins/以下にdir名があるスキンの設定をSCSS化する.
const allDirents = fs.readdirSync('./src/skins/', { withFileTypes: true });
const dirNames = allDirents.filter(dirent => dirent.isDirectory()).map(({ name }) => name);
dirNames.forEach((skin_name) => {
    console.log(skin_name);
    convert_to_scss(skin_name);
})

// 指定のスキン名のスキンの設定をSCSS化する.
function convert_to_scss(skin_name) {
    //skin.jsonを読み込み
    const skin_json = JSON.parse(fs.readFileSync('./src/skins/' + skin_name + '/skin.json', 'utf8'));
    if (skin_json) {
        const skin_name_txt = skin_json['name'];
        // colors
        let editor_colors_txt = "";
        const colors_obj = skin_json['settings']['color']['palette'];
        if (colors_obj) {
            colors_obj.forEach((color) => {
                const color_txt = '"' + color['slug'] + '"' + ' : ' + color['color'] + ',\n';
                console.log(color_txt);
                editor_colors_txt += color_txt;
            });
            console.log(colors_obj.length + ' color has been set.\n');
        }
        // gradients
        let editor_gradients_txt = "";
        const gradients_obj = skin_json['settings']['color']['gradients'];
        if (gradients_obj) {
            gradients_obj.forEach((gradient) => {
                const gradient_txt = '"' + gradient['slug'] + '"' + ' : ' + gradient['gradient'] + ',\n';
                console.log(gradient_txt);
                editor_gradients_txt += gradient_txt;
            });
            console.log(gradients_obj.length + ' gradient has been set.\n');
        }
        // font sizes
        let editor_font_sizes_txt = "";
        const font_sizes_obj = skin_json['settings']['fontSizes'];
        if(font_sizes_obj) {
            font_sizes_obj.forEach((font_size) => {
                const font_size_txt = '"' + font_size['slug'] + '"' + ' : ' + font_size['size'] + ',\n';
                console.log(font_size_txt);
                editor_font_sizes_txt += font_size_txt;
            });
            console.log(font_sizes_obj.length + ' font size has been sets.\n');
        }

        // _skin_config.scssを書き出し
        let scss = ejs.render(template, { skin_name: skin_name_txt, editor_colors: editor_colors_txt, skin_gradients: editor_gradients_txt, skin_font_sizes: editor_font_sizes_txt });
        fs.writeFile('./src/skins/' + skin_name + '/scss/_skin_config.scss', scss, (err) => {
            if (err) {
                console.error('Faild to write' + skin_name_txt + '\'s _skin_config.scss:', err);
            } else {
                console.log(skin_name_txt + '\'s _skin_config.scss has been saved!');
            }
        });
    } else {
        console.error('Your skin.json could not read.', skin_json);
    }
}
