## TODO task :deploy_github
## TODO task :deploy_roland
## TODO task :deploy_localhost

## See: https://github.com/imathis/design-enthusiast
## See: https://github.com/basbossink/basbossink.github.com
## See: http://mikeferrier.com/2011/04/29/blogging-with-jekyll-haml-sass-and-jammit/

require 'fileutils'

site   = "public"         # compiled site folder

task :default => [:help] 

desc "Help on this Rakefile"
task :help do
  system "rake -T"
end

desc "Generate website in '#{site}'"
task :generate => [:generate_site, :generate_style] do
  puts ">>> Site Generating Complete! <<<\n\n"
end

desc "Parse haml layouts"
task :parse_haml do
  puts ">>> creating HAML layout <<<"
  Dir["_layouts/haml/*.haml"].each do |f|
    html = ""
    open("|haml #{f}") do |f|
      html = f.read
    end
    open("_layouts/#{File.basename(f,'.haml')}.html", "w") do |f|
      f.puts "---"
      f.puts "---"
      f.write html
    end
  end
end

desc "Generate the style sheets only"
task :generate_style do
  puts ">>> Generating styles <<<"
  system(%{compass compile})
end

desc "Remove generated website in '#{site}'"
task :clean do
  puts ">>> Removing output <<<"
  Dir["#{site}/*"].each { |f| rm_rf(f) }
end

desc "Deploy to localhost"
task :deploy_local do
  puts ">>> Deploying to local apache <<<"
  Dir["#{site}/*"].each do |f|
    cp_r f, '/home/endymion/www/idris/html'
  end
end

desc "Convert old gastenboek to XML"
task :convert_gastenboek do
  system(%{ruby convert_gastenboek.rb > source/content/gastenboek/gastenboek.xml})
end

