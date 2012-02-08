module Jekyll
  require 'haml'
  class HamlConverter < Converter
    safe true
    priority :low

    def matches(ext)
      ext =~ /haml/i
    end

    def output_ext(ext)
      ".html"
    end

    def convert(content)
      #puts ">>>>>>>>>>>>>>>"
      #puts content[0..200]
      engine = Haml::Engine.new(content)
      engine.render
    end
  end
end
