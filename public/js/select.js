function dropdown() {
    return {
      search: '',
      open: false,
      items: ['Option 1', 'Option 2', 'Option 3', 'Option 4', 'Option 5'],
      highlightedIndex: 0,
      get filteredItems() {
        return this.items.filter(item => item.toLowerCase().includes(this.search.toLowerCase()));
      },
      highlightNext() {
        if (this.highlightedIndex < this.filteredItems.length - 1) {
          this.highlightedIndex++;
        }
      },
      highlightPrev() {
        if (this.highlightedIndex > 0) {
          this.highlightedIndex--;
        }
      },
      selectItem(index = this.highlightedIndex) {
        this.search = this.filteredItems[index];
        this.open = false;
      }
    }
  }