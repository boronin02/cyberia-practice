import Image from "next/image";

type handleLogo = {
  isDark: boolean;
};

export const Logo = ({ isDark }: handleLogo) => {
  return (
    <>
      <div>
        {isDark ? (
          <Image src="/logoWhite.svg" alt="logo" width={174} height={32} />
        ) : (
          <Image src="/logo.svg" alt="logoWhite" width={174} height={32} />
        )}
      </div>
    </>
  );
};
