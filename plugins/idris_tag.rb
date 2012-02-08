# Use it like: {% youtube Hj33WNhLqOU 640 510 %}

module Jekyll
  class Idris < Liquid::Tag

    def initialize(name, text, tokens)
      super
    end

    def render(context)
      %(<span class='idris'>Idris</span>)
    end
  end
end

Liquid::Template.register_tag('idris', Jekyll::Idris)
