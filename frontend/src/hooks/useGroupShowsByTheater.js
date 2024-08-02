// nhóm các shows(xuất chiếu) trong cùng 1 rạp
export const useGroupShowsByTheater = (shows, theaters) => {
  if (!shows || !theaters) {
    return [];
  }
  console.log("hooks group", theaters);

  const groupShowsObject = shows.reduce((accumulator, currentShow) => {
    const theaterID = currentShow.theaters_id;
    if (!accumulator[theaterID]) {
      accumulator[theaterID] = { ...currentShow };
      accumulator[theaterID]["listShowID"] = [];
    }
    accumulator[theaterID]["listShowID"].push(currentShow.time);
    accumulator[theaterID]["theater"] = theaters?.find(
      (item) => item.theater_id === theaterID
    );
    return accumulator;
  }, {});
  return Object.values(groupShowsObject);
};
