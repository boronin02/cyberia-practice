import Image from "next/image";

export const Logo = () => {
  return (
    <>
      <div>
        <Image src="/logo.svg" alt="logo" width={174} height={32} />
      </div>
    </>
  );
};
