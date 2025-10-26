#!/usr/bin/env python3
import re
import sys

def minify_css(css_content):
    # Remove comments
    css_content = re.sub(r'/\*.*?\*/', '', css_content, flags=re.DOTALL)
    # Remove extra whitespace
    css_content = re.sub(r'\s+', ' ', css_content)
    # Remove spaces around specific characters
    css_content = re.sub(r'\s*([{}:;,>+~])\s*', r'\1', css_content)
    # Remove leading/trailing whitespace
    css_content = css_content.strip()
    return css_content

def minify_js(js_content):
    # Remove single-line comments
    js_content = re.sub(r'//.*$', '', js_content, flags=re.MULTILINE)
    # Remove multi-line comments
    js_content = re.sub(r'/\*.*?\*/', '', js_content, flags=re.DOTALL)
    # Remove extra whitespace
    js_content = re.sub(r'\s+', ' ', js_content)
    # Remove spaces around specific characters
    js_content = re.sub(r'\s*([{}();,=+\-*/])\s*', r'\1', js_content)
    # Remove leading/trailing whitespace
    js_content = js_content.strip()
    return js_content

if __name__ == "__main__":
    if len(sys.argv) != 3:
        print("Usage: python3 minify.py <input_file> <output_file>")
        sys.exit(1)
    
    input_file = sys.argv[1]
    output_file = sys.argv[2]
    
    with open(input_file, 'r', encoding='utf-8') as f:
        content = f.read()
    
    if input_file.endswith('.css'):
        minified = minify_css(content)
    elif input_file.endswith('.js'):
        minified = minify_js(content)
    else:
        print("Unsupported file type")
        sys.exit(1)
    
    with open(output_file, 'w', encoding='utf-8') as f:
        f.write(minified)
    
    print(f"Minified {input_file} -> {output_file}")
