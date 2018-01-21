class CreateUrls < ActiveRecord::Migration[5.1]
  def change
    create_table :urls do |t|
      t.text :url, null: false
      t.boolean :visited, default: false

      t.timestamps
    end
  end
end
